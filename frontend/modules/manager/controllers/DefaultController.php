<?php

namespace frontend\modules\manager\controllers;

use common\models\Person;
use common\models\search\StudentPaySearch;
use common\models\StudentPay;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;
/**
 * Default controller for the `manager` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $branch_id = Yii::$app->user->identity->branch_id;
        $monthly_person = Person::find()->where(['branch_id'=>$branch_id])->andFilterWhere(['like','created',date('Y-m')])->count('id');

        $monthly_price = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>3])->andFilterWhere(['like','created',date('Y-m')])->sum('price');

        $monthly_price_5 = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>2])->sum('price');

        $tasdiqlangan = '';
        for($i=1; $i<=12; $i++){
            if($i<10){
                $t = '0'.$i;
            }else{
                $t = $i;
            }
            if($q = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>3])->andFilterWhere(['like','updated',date('Y-').$t])->sum('price')){
                $tasdiqlangan .= $q.',';
            }else{
                $tasdiqlangan .= '0,';

            }
        }
        $tasdiqlangan = substr($tasdiqlangan,0,strlen($tasdiqlangan)-1);

        $kutilyotgan = '';
        for($i=1; $i<=12; $i++){
            if($i<10){
                $t = '0'.$i;
            }else{
                $t = $i;
            }
            if($q = StudentPay::find()->where(['branch_id'=>$branch_id])->andFilterWhere(['like','pay_date',date('Y-').$t])->sum('price')){
                $kutilyotgan .= $q.',';
            }else{
                $kutilyotgan .= '0,';

            }
        }
        $kutilyotgan = substr($kutilyotgan,0,strlen($kutilyotgan)-1);


        return $this->render('index',[
            'monthly_person'=>$monthly_person,
            'monthly_price'=>$monthly_price,
            'monthly_price_5'=>$monthly_price_5,
            'tasdiqlangan'=>$tasdiqlangan,
            'kutilyotgan'=>$kutilyotgan
        ]);
    }

    public function actionPay(){

        $searchModel = new StudentPaySearch();
        $dataProvider = $searchModel->searchManager($this->request->queryParams);

        return $this->render('pay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPaysend($id,$student_id){
        if($model = StudentPay::findOne(['id'=>$id,'student_id'=>$student_id,'branch_id'=>Yii::$app->user->identity->branch_id])){
            $code = $model->code;
            $price = $model->price;
            $model->scenario = "paying";
            if($model->load($this->request->post())){
                $model->code = $code;
                $model->price = $price;
                $model->user_id = Yii::$app->user->id;
                if($model->check_file = UploadedFile::getInstance($model,'check_file')){
                    $name = microtime(true).'.'.$model->check_file->extension;
                    $model->check_file->saveAs(Yii::$app->basePath.'/web/uploads/check/'.$name);
                    $model->check_file = $name;
                }
                $model->status_id = 2;
                if($model->save()){
                    return $this->redirect(['view','id'=>$model->id,'student_id'=>$model->student_id]);
                }
            }
            return $this->render('_paysend',['model'=>$model,'student'=>$model->student]);

        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionView($student_id, $id)
    {
        $model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id]);
        return $this->render('view', [
            'model' => $model
        ]);
    }
}
