<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tax $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tax-form">

    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/bux/tax/confirm','id'=>$model->id])]); ?>

    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TaxType::find()->all(),'id','name'),['disabled'=>true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'tax_bank')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    <br>
    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads')->textarea(['rows' => 4]) ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
