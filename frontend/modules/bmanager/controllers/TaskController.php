<?php

namespace frontend\modules\bmanager\controllers;
use common\models\search\TaskAnswerSearch;
use common\models\search\TaskSearch;
use common\models\Task;
use common\models\TaskAnswer;
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
                        'accept' => ['POST'],
                        'accepttask' => ['POST'],
                        'deletetask' => ['POST'],
                        'close' => ['POST'],
                        'send' => ['POST'],
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

    public function actionClose($id){
        $task = Task::findOne($id);
        $task->status_id = 4;
        if($task->save()){
            $tuser = TaskUser::find()->where(['task_id'=>$task->id])->all();
            foreach ($tuser as $item){
                $item->status_id = 5;
                $item->save();
            }
        }
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

                    if($model->role){
                        $us = User::find()->where(['role_id'=>$model->role])->all();
                        foreach ($us as $item){
                            $tuser = new TaskUser();
                            $tuser->exec_id = $item->id;
                            $tuser->deadline = $model->deadline;
                            $tuser->type_id = 1;
                            $tuser->user_id = $model->user_id;
                            $tuser->task_id = $model->id;
                            $tuser->status_id = 1;
                            $tuser->sms_status = 0;
                            $tuser->save();
                        }
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

    public function actionAnswers(){
        $searchModel = new TaskAnswerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('answers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionSend($id){
        $model = $this->findModel($id);
        $model->status_id = 3;
        $model->save();
        return $this->redirect(['view','id'=>$id]);
    }

    public function actionViewanswer($id,$task_id,$user_id){
        if($model = TaskAnswer::findOne(['user_id'=>$user_id,'id'=>$id,'task_id'=>$task_id])){
            if($model->status_id == 1){
                $model->status_id = 2;
                $model->save();
            }
            return $this->renderAjax('_viewanswer',['model'=>$model]);
        }else{
            return "Bunday javob topilmadi";
        }
    }

    public function actionAccept($id,$task_id,$user_id){
        $model = TaskAnswer::findOne(['id'=>$id,'task_id'=>$task_id,'user_id'=>$user_id]);
        $model->status_id = 3;
        $model->save();
        $model = TaskUser::find()->where(['task_id'=>$task_id,'exec_id'=>$user_id])->all();
        foreach ($model as $item){
            $item->status_id = 5;
            $item->save();
        }
        return $this->redirect(['view','id'=>$task_id]);
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

    public function actionAddtask($id){
        $model = new TaskUser();
        $task = Task::findOne($id);
        if($model->load($this->request->post())){
            $model->task_id = $task->id;
            $model->status_id = 1;
            $model->user_id = $task->creator_id;
            $model->sms_status = 0;
            if(!$model->deadline){
                $model->deadline = $task->deadline;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Topshiriq yuborildi');
            }else{
                Yii::$app->session->setFlash('error','Topshiriqni yuborishda xatolik');
            }
        }

        return $this->redirect(['view','id'=>$task->id]);
    }

    public function actionAccepttask($id,$exec_id){
        $task = TaskUser::findOne(['task_id'=>$id,'exec_id'=>$exec_id,'user_id'=>Yii::$app->user->id]);
        $task->status_id = 5;
        $task->save();
        return $this->redirect(['view','id'=>$id]);
    }

    public function actionDeletetask($id,$exec_id){
        $task = TaskUser::findOne(['task_id'=>$id,'exec_id'=>$exec_id,'user_id'=>Yii::$app->user->id]);
        if($task->status_id < 5){
            $task->delete();
        }
        return $this->redirect(['view','id'=>$id]);
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
