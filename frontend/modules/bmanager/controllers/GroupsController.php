<?php

namespace frontend\modules\bmanager\controllers;

use common\models\Groups;
use common\models\GroupTeacher;
use common\models\Person;
use common\models\PersonWish;
use common\models\PersonWishHistory;
use common\models\search\GroupsSearch;
use common\models\Student;
use common\models\StudentPay;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
                        'stop' => ['POST'],
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
        $dataProvider = $searchModel->searchBman($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionPaying($id, $i = 0)
    {
        if ($student = Student::findOne(['id' => $id, 'branch_id' => Yii::$app->user->identity->branch_id])) {
            $pay = StudentPay::find()->where(['student_id' => $id])->orderBy(['id' => SORT_ASC])->all();
            return $this->renderAjax('paying', ['pay' => $pay, 'student' => $student]);
        } else {
            return "Bunday talaba topilmadi";
        }
    }

    public function actionPaysend($id, $student_id)
    {
        if ($model = StudentPay::findOne(['id' => $id, 'student_id' => $student_id, 'branch_id' => Yii::$app->user->identity->branch_id])) {
            $code = $model->code;
            $price = $model->price;
            $model->scenario = "paying";
            if ($model->load($this->request->post())) {
                $model->code = $code;
                $model->price = $price;
                $model->user_id = Yii::$app->user->id;
                if ($model->check_file = UploadedFile::getInstance($model, 'check_file')) {
                    $name = microtime(true) . '.' . $model->check_file->extension;
                    $model->check_file->saveAs(Yii::$app->basePath . '/web/uploads/check/' . $name);
                    $model->check_file = $name;
                }
                $model->status_id = 2;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->student->group_id]);
                }
            }
            return $this->render('_paysend', ['model' => $model, 'student' => $model->student]);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
                $model->duration = $model->course->duration;
                $code = Groups::find()->where(['branch_id'=>Yii::$app->user->identity->branch_id])->andFilterWhere(['like','created',date('Y')])->max('code_id');
                $code=$code+1;
                $model->code_id = $code;
                $model->name = Yii::$app->user->identity->branch->code.'/'.date('Y').'-'.$code;
                if ($model->save()) {
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
            if ($model->status_id == 1 && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Kurs boshlangandan keyin kurs ma`lumotlarini o`zgartirish mumkin emas!');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAdd($id, $person_id, $course_id)
    {
        $model = new Student();
        $model->person_id = $person_id;
        $model->group_id = $id;
        $model->status = 0;
        if ($wish = PersonWish::findOne(['person_id' => $person_id, 'course_id' => $course_id, 'branch_id' => Yii::$app->user->identity->branch_id])
            and $group = Groups::findOne(['id' => $id, 'course_id' => $course_id, 'branch_id' => Yii::$app->user->identity->branch_id])) {
            if ($model->load($this->request->post())) {
                $model->code_id = Student::find()->where(['branch_id' => Yii::$app->user->identity->branch_id])->andFilterWhere(['like', 'created', date('Y')])->max('code_id');
                $model->code_id++;
                $model->code = substr(date('Y'), 2, 2) . '/' . Yii::$app->user->identity->branch->code . '-' . $model->code_id;
                $model->branch_id = Yii::$app->user->identity->branch_id;
                $model->creator_id = Yii::$app->user->id;
                if($model->group->type_id == 2){
                    $model->student_social_id = 4;
                    $model->social_id = 1;
                }else{
                    $model->type_id = 1;
                }
                if($model->has_discount == 1){
                    if($model->discount_file = UploadedFile::getInstance($model,'discount_file')){
                        $name = microtime(true).'.'.$model->discount_file->extension;
                        $model->discount_file->saveAs(Yii::$app->basePath.'/web/uploads/discount/'.$name);
                        $model->discount_file = $name;
                    }else{
                        Yii::$app->session->setFlash('error','Imtiyoz fayli kiritilmagan.');
                        return $this->redirect(['view', 'id' => $id]);
                    }
                }else{
                    $model->discount = 0;
                    $model->discount_file = "";
                }
                if ($model->save()) {
                    // pay generate
                    for ($i = 0; $i < $wish->course->duration; $i++) {
                        $pay = new StudentPay();
                        $pay->student_id = $model->id;
                        $pay->status_id = 1;
                        $pay->code = $model->code;
                        $pay->price = $model->group->price;
                        $pay->branch_id = Yii::$app->user->identity->branch_id;
                        $pay->id = $i;
                        $pay->save();
                    }

                    $wish->delete();
                }
                return $this->redirect(['view', 'id' => $id]);
            }
            return $this->renderAjax('_add', [
                'model' => $model
            ]);
        } else {
            return "Bunday o`quvchi topilmadi";
        }
    }


    public function actionStop($id)
    {
        if ($model = Groups::findOne(['id' => $id, 'branch_id' => Yii::$app->user->identity->branch_id])) {
            $model->status_id = 3;
            if($model->save()){
                $student = Student::find()->where(['group_id' => $model->id])->andWhere(['status'=>1])->all();
                foreach ($student as $item){
                    $item->status = 3;
                    $item->end_date = date('Y-m-d');
                    $item->save(false);
                }
            }
            Yii::$app->session->setFlash('success','Guruh o`qishni tugatganligi muvoffaqiyatli saqlandi.');
            return $this->redirect(['view','id'=>$id]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStart($id)
    {
        if ($model = Groups::findOne(['id' => $id, 'branch_id' => Yii::$app->user->identity->branch_id])) {

            if ($model->load($this->request->post())) {
                if(count($model->students)>2){

                    $model->status_id = 2;

                    $teacher = new GroupTeacher();
                    $teacher->teacher_id = $model->teacher_id;
                    $teacher->group_id = $model->id;
                    $teacher->status = 1;


                    if ($model->save() and $teacher->save()) {
                        $student = Student::find()->where(['group_id' => $model->id])->all();
                        $date = [];
                        $time = $model->start_date;
                        $time = date("Y-m-d", strtotime($time . "+4 days"));
                        for ($i = 0; $i < $model->duration; $i++) {
                            $final = date("Y-m-d", strtotime($time . "+{$i} month"));
                            $date[$i] = $final;
                        }

                        foreach ($student as $item) {
                            $pay = StudentPay::find()->where(['student_id' => $item->id])->all();
                            foreach ($pay as $i) {
                                $i->pay_date = null;
                                $i->save();
                            }
                            $item->status = 1;
                            $item->save(false);
                            for ($i = 0; $i < $model->duration; $i++) {
                                if ($pay = StudentPay::find()->where(['student_id' => $item->id])->andWhere(['id' => $i])->one()) {
                                    $pay->pay_date = $date[$i];
                                    $pay->save();
                                } else {
                                    $pay = new StudentPay();
                                    $pay->student_id = $item->id;
                                    $pay->status_id = 1;
                                    $pay->code = $item->code;
                                    $pay->price = $model->price;
                                    $pay->branch_id = Yii::$app->user->identity->branch_id;
                                    $pay->id = $i;
                                    $pay->pay_date = $date[$i];
                                    $pay->save();
                                }
                            }
                        }
                        Yii::$app->session->setFlash('success','Guruhga muvoffaqiyatli start berildi');

                    }else{
                        Yii::$app->session->setFlash('error','Ma`lumotlarni saqlashda xatolik');
                    }
                }else{
                    Yii::$app->session->setFlash('error','Guruhdagi bolalar soni 3 dan kamligi sababli darslarni boshlay olmaysiz.');
                }
                return $this->redirect(['view', 'id' => $id]);

            }

            return $this->renderAjax('_start', ['model' => $model]);
        } else {
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
        if (($model = Groups::findOne(['id' => $id,])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
