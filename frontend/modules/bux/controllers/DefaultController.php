<?php

namespace frontend\modules\bux\controllers;

use common\models\search\StudentPaySearch;
use common\models\StudentPay;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `bux` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'accept' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPay(){

        $searchModel = new StudentPaySearch();
        $dataProvider = $searchModel->searchBux($this->request->queryParams);

        return $this->render('pay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($student_id, $id)
    {
        $model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id]);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionAccept($student_id,$id,$type){
        if($model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id,'status_id'=>2])){
            $model->status_id = 3;
            $model->consept_id = \Yii::$app->user->id;
            $model->save();
            return $this->redirect(['view','id'=>$id,'student_id'=>$student_id]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeny($student_id,$id){
        if($model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id,'status_id'=>2])){
            $model->status_id = 5;
            $model->consept_id = \Yii::$app->user->id;
            if($model->load($this->request->post()) and $model->save()){
                return $this->redirect(['view','id'=>$id,'student_id'=>$student_id]);
            }
            return $this->renderAjax('deny',['model'=>$model]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
