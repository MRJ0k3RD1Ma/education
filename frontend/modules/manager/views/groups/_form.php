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

    <?php $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map(\common\models\Cource::find()->where(['status'=>1])->all(),'id','name')) ?>

    <?= $form->field($model, 'day_id')->dropDownList(ArrayHelper::map(\common\models\GroupDay::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'time')->dropDownList(Yii::$app->params['times']) ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\common\models\GroupType::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'room_id')->dropDownList(ArrayHelper::map(\common\models\Room::find()->all(),'id','name')) ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
