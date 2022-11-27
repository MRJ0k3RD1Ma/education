<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\GroupsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="groups-search">

    <!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
         aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Qidiruv</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'course_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Cource::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\GroupStatus::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?php echo $form->field($model, 'start_date')->textInput(['type'=>'date']) ?>

            <?php  echo $form->field($model, 'day_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\GroupDay::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?php // echo $form->field($model, 'time') ?>

            <?php  echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\GroupType::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?php //  echo $form->field($model, 'price') ?>

            <?php // echo $form->field($model, 'created') ?>

            <?php // echo $form->field($model, 'updated') ?>

            <?php // echo $form->field($model, 'creator_id') ?>

            <?php // echo $form->field($model, 'room_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Room::find()->all(),'id','name')) ?>
            <br>

            <div class="form-group">
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>
