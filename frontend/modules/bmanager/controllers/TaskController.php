<?php

namespace frontend\modules\bmanager\controllers;
use common\models\search\TaskSearch;
use common\models\Task;
use common\models\TaskFile;
use common\models\TaskUser;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate(){
        $model = new Task();
        $user = ArrayHelper::map(User::find()->where(['status'=>1,'state'=>1])->andWhere(['>','role_id','2'])->all(),'id','name');
        $exec = new TaskUser();
        $files = new TaskFile();
        if($post = Yii::$app->request->post()){

            if($model->load($this->request->post())){

                $model->status_id = 1;
                $model->creator_id = Yii::$app->user->id;
                $model->user_id = $model->creator_id;
                $cid = Task::find()->max('code_id');
                if(!$cid){
                    $cid = 0;
                }
                $cid = $cid + 1;
                $model->code_id = $cid;
                $model->code = $cid.'-'.date('Y');

                $fls = UploadedFile::getInstances($model,'files');

                $model->files = null;

                if($model->save()){


                    //file save

                    foreach ($fls as $item){
                        $id = TaskFile::find()->where(['task_id'=>$model->id])->max('id');
                        if(!$id){
                            $id = 0;
                        }
                        $id++;
                        $name = microtime(true).$id.'.'.$item->extension;
                        $item->saveAs(Yii::$app->basePath.'/web/uploads/task/'.$name);

                        $tf = new TaskFile();
                        $tf->user_id = $model->user_id;
                        $tf->file = $name;
                        $tf->id = $id;
                        $tf->task_id = $model->id;
                        $tf->save();

                    }

                    //Send tasks to users
                    if(key_exists('TaskUser',$post)){
                        foreach ($post['TaskUser'] as $key => $item){
                            $tuser = new TaskUser();
                            if($item['exec_id']){
                                $tuser->exec_id = $item['exec_id'];
                                $tuser->deadline = $item['deadline'] ? $item['deadline'] : $model->deadline;
                                $tuser->type_id = $item['type_id'] ? $item['type_id'] : 1;
                                $tuser->user_id = $model->user_id;
                                $tuser->task_id = $model->id;
                                $tuser->status_id = 1;
                                $tuser->sms_status = 0;
                                $tuser->save();
                            }
                        }
                    }
                }else{
                    echo "<pre>";
                    var_dump($model);
                    exit;
                }
                return $this->redirect(['view','id'=>$model->id]);
            }
        }
        return $this->render('create',[
            'model'=>$model,
            'user'=>$user,
            'exec'=>$exec,
            'files'=>$files
        ]);
    }

    public function actionGetexec($key){
        return $this->renderAjax('_getexec',['key'=>$key]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->state = 0;
        $model->status = 0;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
