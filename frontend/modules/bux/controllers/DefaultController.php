<?php

namespace frontend\modules\bux\controllers;

use common\models\Branch;
use common\models\Payment;
use common\models\search\StudentPaySearch;
use common\models\Student;
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
    public function actionIndex($date = null)
    {

        $model = Payment::find()->all();
        $branch = Branch::find()->all();
        if(!$date){
            $date = date('m');
        }
        if($date < 10){
            $date = '0'.$date;
        }
        $pay = [];
        foreach ($model as $i){
            $price = StudentPay::find()
                ->andFilterWhere(['like','paid_date',date('Y').'-'.$date])
                ->andWhere(['payment_id'=>$i->id,'status_id'=>3])->sum('price');
            $pay[0][$i->id] = $price ? $price : 0;
        }
        foreach ($branch as $item){

            foreach ($model as $i){
                $price = StudentPay::find()
                    ->andFilterWhere(['like','paid_date',date('Y').'-'.$date])
                    ->andWhere(['branch_id'=>$item->id,'payment_id'=>$i->id,'status_id'=>3])->sum('price');
                $pay[$item->id][$i->id] = $price ? $price : 0;
            }
        }

        return $this->render('index',[
            'model'=>$model,
            'branch'=>$branch,
            'pay'=>$pay
        ]);
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
            if($model->save()){
                // personni to'lovlari to'liq o'tgan o'tmaganini aniqlab is_full_paid ni 1 yoki 0 qilish kerak.
                if(0 == StudentPay::find()->where(['student_id'=>$student_id])->andWhere(['<>','status_id',3])->count('*')){
                    $student = Student::findOne($student_id);
                    $student->is_full_paid = 1;
                    $student->save(false);
                }
            }
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
