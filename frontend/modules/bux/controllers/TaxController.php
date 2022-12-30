<?php

namespace frontend\modules\bux\controllers;

use common\models\Tax;
use common\models\search\TaxSearch;
use common\models\TaxUsual;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * TaxController implements the CRUD actions for Tax model.
 */
class TaxController extends Controller
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
     * Lists all Tax models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaxSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tax model.
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
     * Creates a new Tax model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tax();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->creator_id = Yii::$app->user->id;
                if($model->file = UploadedFile::getInstance($model,'file')){
                    $name = microtime(true).'.'.$model->file->extension;
                    $model->file->saveAs(Yii::$app->basePath.'/web/uploads/tax/'.$name);
                    $model->file = $name;
                }
                $model->status = 0;
                if($model->save()){
                    $txt = "Soliq to`lovi saqlandi va tasdiqlash uchun tayyorlandi";
                    if($model->is_usual == 1){
                        $us = new TaxUsual();
                        $us->type_id = $model->type_id;
                        $us->price = $model->price;
                        $us->tax = $model->tax;
                        $us->tax_bank = $model->tax_bank;
                        $us->ads = $model->ads;
                        $us->creator_id = $model->creator_id;
                        $us->save();
                        $txt .= ". To`lov doimiy harajatlarga qo`shildi";
                    }
                    Yii::$app->session->setFlash('success',$txt);
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

    public function actionConfirm($id){
        $model = $this->findModel($id);
        $file = $model->file;
        if($model->load($this->request->post())){
            if($model->file = UploadedFile::getInstance($model,'file')){
                $name = microtime(true).'.'.$model->file->extension;
                $model->file->saveAs(Yii::$app->basePath.'/web/uploads/tax/'.$name);
                $model->file = $name;
            }else{
                $model->file = $file;
            }
            if($model->file){
                $model->confirm_id = Yii::$app->user->id;
                $model->status = 1;
                if($model->save()){
                    Yii::$app->session->setFlash('success',"To`lov tasdiqlandi");
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                Yii::$app->session->setFlash('error',"To`lovning fayli mavjud emas");
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Updates an existing Tax model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = $model->file;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->file = UploadedFile::getInstance($model,'file')){
                $name = microtime(true).'.'.$model->file->extension;
                $model->file->saveAs(Yii::$app->basePath.'/web/uploads/tax/'.$name);
                $model->file = $name;
            }else{
                $model->file = $file;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tax model.
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
     * Finds the Tax model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tax the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tax::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
