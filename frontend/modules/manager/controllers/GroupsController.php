<?php

namespace frontend\modules\manager\controllers;

use common\models\Groups;
use common\models\Person;
use common\models\PersonPay;
use common\models\PersonWish;
use common\models\PersonWishHistory;
use common\models\search\GroupsSearch;
use common\models\Student;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
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
     * Lists all Groups models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Groups model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Groups();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status_id = 1;
                $model->creator_id = Yii::$app->user->id;
                $model->branch_id = Yii::$app->user->identity->branch_id;
                $model->price = $model->course->price;
                $model->duration = $model->course->duration;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Groups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->price = $model->course->price;
            $model->duration = $model->course->duration;
            if($model->status_id == 1 && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error','Kurs boshlangandan keyin kurs ma`lumotlarini o`zgartirish mumkin emas!');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAdd($id,$person_id,$course_id){
        $model = new Student();
        $model->person_id = $person_id;
        $model->group_id = $id;
        $model->status = 1;
        if($wish = PersonWish::findOne(['person_id'=>$person_id,'course_id'=>$course_id,'branch_id'=>Yii::$app->user->identity->branch_id])
        and $group = Groups::findOne(['id'=>$id,'course_id'=>$course_id,'branch_id'=>Yii::$app->user->identity->branch_id])){
            if($model->load($this->request->post())){
                $model->code_id = Student::find()->where(['branch_id'=>Yii::$app->user->identity->branch_id])->andFilterWhere(['like','created',date('Y')])->max('code_id');
                $model->code_id ++;
                $model->code = substr(date('Y'),2,2).'/'.Yii::$app->user->identity->branch->code.'-'.$model->code_id;
                $model->branch_id = Yii::$app->user->identity->branch_id;
                $model->creator_id = Yii::$app->user->id;
                if($model->save()){
                    // pay generate
                    for($i=0; $i<$wish->course->duration; $i++){
                        $pay = new PersonPay();
                        $pay->person_id = $model->person_id;
                        $pay->status_id = 1;
                        $pay->group_id = $model->group_id;
                        $pay->code = $model->code;
                        $pay->price = $model->group->price;
                        $pay->id = $i;
                        $pay->save();
                    }

                    $wish->delete();
                }
                return $this->redirect(['view','id'=>$id]);
            }
            return $this->renderAjax('_add',[
                'model'=>$model
            ]);
        }else{
            return "Bunday o`quvchi topilmadi";
        }
    }

    public function actionStart($id){
        if($model = Groups::findOne(['id'=>$id,'branch_id'=>Yii::$app->user->identity->branch_id])){

            if($model->load($this->request->post())){
                $model->status_id = 2;
                if($model->save()){
                    $student = Student::find()->where(['group_id'=>$model->id])->all();
                    $date = [];
                    $time = strtotime("Y-m-d");
                    $time = date("Y-m-d", strtotime($time."+4 days"));
                    for($i=0; $i<$model->duration; $i++){
                        $final = date("Y-m-d", strtotime($time."+{$i} month"));
                        $date[$i] = $final;
                    }

                    foreach ($student as $item){
                        $pay = PersonPay::find()->where(['person_id'=>$item->person_id,'group_id'=>$model->id])->all();
                        foreach ($pay as $i){
                            $i->pay_date = null;
                            $i->save();
                        }
                        for($i=0; $i<$model->duration; $i++){
                            if($pay = PersonPay::find()->where(['person_id'=>$item->person_id,'group_id'=>$model->id])->andWhere(['id'=>$i])->one()){
                                $pay->pay_date = $date[$i];
                                $pay->save();
                            }else{
                                $pay = new PersonPay();
                                $pay->id = $i;
                                $pay->person_id = $item->person_id;
                                $pay->status_id = 1;
                                $pay->group_id = $model->id;
                                $pay->code = $item->code;
                                $pay->price = $model->price;
                                $pay->pay_date = $date[$i];
                                $pay->save();
                            }
                        }
                    }
                    return $this->redirect(['view','id'=>$id]);
                }
            }

            return $this->renderAjax('_start',['model'=>$model]);
        }else{
            return "Bunday guruh topilmadi";
        }
    }

    /**
     * Deletes an existing Groups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne(['id' => $id,'branch_id'=> Yii::$app->user->identity->branch_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
