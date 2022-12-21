<?php

namespace frontend\modules\manager\controllers;
use common\models\search\TaskSearch;
use common\models\Task;
use common\models\TaskAnswer;
use common\models\TaskAnswerFile;
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
        $dataProvider = $searchModel->searchManager($this->request->queryParams);

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
        $task = TaskUser::find()->where(['exec_id'=>Yii::$app->user->id,'task_id'=>$id])->andWhere('(user_id='.$model->user_id.' or user_id='.$model->creator_id.')')->one();
        if($task->status_id == 1){
            $task->status_id = 2;
            $task->save();
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionAnswer($id){
        $task = $this->findModel($id);
        if($task->status_id == 4){
            return "Bu topshiriq yopilgan javob kiritish mumkin emas.";
        }
        $model = new TaskAnswer();
        if($model->load($this->request->post())){

            $fls = UploadedFile::getInstances($model,'files');
            $model->user_id = Yii::$app->user->id;
            $model->task_id = $id;
            $id = TaskAnswer::find()->where(['task_id' => $task->id,'user_id'=>Yii::$app->user->id])->max('id');
            if(!$id){
                $id = 0;
            }
            $id ++;
            $model->id = $id;
            $model->files = null;
            $model->status_id = 1;
            if($model->save()) {
                //file save

                $tk = TaskUser::find()->where(['exec_id'=>Yii::$app->user->id,'task_id'=>$task->id])->andWhere('(user_id='.$task->user_id.' or user_id='.$task->creator_id.')')->one();
                $tk->status_id = 4;
                $tk->save();

                foreach ($fls as $item) {
                    $id = TaskAnswerFile::find()->where(['task_id' => $task->id,'user_id'=>Yii::$app->user->id,'ans_id'=>$model->id])->max('id');
                    if (!$id) {
                        $id = 0;
                    }
                    $id++;
                    $name = microtime(true) . $id . '.' . $item->extension;
                    $item->saveAs(Yii::$app->basePath . '/web/uploads/task_answer/' . $name);

                    $tf = new TaskAnswerFile();
                    $tf->user_id = $model->user_id;
                    $tf->ans_id = $model->id;
                    $tf->file = $name;
                    $tf->id = $id;
                    $tf->task_id = $task->id;
                    $tf->save();

                }
            }
            return $this->redirect(['view','id'=>$task->id]);
        }
        return $this->renderAjax('_answer',['model'=>$model,'task'=>$task]);
    }


    public function actionViewanswer($id,$task_id){
        if($model = TaskAnswer::findOne(['user_id'=>Yii::$app->user->id,'id'=>$id,'task_id'=>$task_id])){


            return $this->renderAjax('_viewanswer',['model'=>$model]);
        }else{
            return "Bunday javob topilmadi";
        }
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
        if (($model = Task::find()->where(['id'=>$id])->andWhere('id in (select task_id from task_user where task_id='.$id.' and exec_id='.Yii::$app->user->id.')')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
