<?php

namespace frontend\modules\manager\controllers;

use common\models\Analytics;
use common\models\AnalyticsType;
use common\models\Person;
use common\models\PersonWish;
use common\models\search\PersonSearch;
use common\models\Student;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
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
     * Lists all Person models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Person();
        $wish = new PersonWish();
        $analitics = AnalyticsType::find()->where(['status'=>1])->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if($model->checked == 1 and $wish->load($this->request->post())){
                    $wish->branch_id = Yii::$app->user->identity->branch_id;
                    $wish->person_id = $model->id;
                    $wish->save();
                }
                foreach ($model->analitics as $key => $item){
                    if($item == 1){
                        $a = new Analytics();
                        $a->person_id = $model->id;
                        $a->type_id = $key;
                        $a->save();
                        $a = null;
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'wish'=>$wish,
            'analitics'=>$analitics
        ]);
    }

    public function actionAdd($id){

        $model = new PersonWish();
        $model->person_id = $id;
        $model->branch_id = Yii::$app->user->identity->branch_id;
        if($model->load($this->request->post())){
            if($model->save()){
                return $this->redirect(['view','id'=>$id]);
            }
        }

        return $this->render('add',['model'=>$model]);

    }

    public function actionDelwish($person_id,$course_id){
        if($model = PersonWish::find()->where(['person_id'=>$person_id,'course_id'=>$course_id])->andWhere(['branch_id'=>Yii::$app->user->identity->branch_id])->one()){
            $model->delete();
        }
        return $this->redirect(['view','id'=>$person_id]);
    }
    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
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
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
