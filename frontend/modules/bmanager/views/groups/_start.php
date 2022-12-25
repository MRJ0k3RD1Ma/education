<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Groups $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model,'teacher_id')->dropDownList(ArrayHelper::map(\common\models\User::find()->where(['role_id'=>1])->andWhere(['branch_id'=>Yii::$app->user->identity->branch_id])->all(),'id','name'))?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Start', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
