<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\StudentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-search">

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

            <?php $form->field($model, 'id') ?>

            <?= $form->field($model, 'code') ?>

            <?php $form->field($model, 'code_id') ?>

            <?= $form->field($model, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Groups::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?= $form->field($model, 'per')->label('FIO') ?>

            <?php echo $form->field($model, 'social_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PersonSocial::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?php  echo $form->field($model, 'project_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Project::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?php // echo $form->field($model, 'created') ?>

            <?php // echo $form->field($model, 'updated') ?>

            <?php // echo $form->field($model, 'creator_id') ?>

            <?php // echo $form->field($model, 'branch_id') ?>

            <?php  echo $form->field($model, 'status')->dropDownList(Yii::$app->params['status_student'],['prompt'=>'']) ?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>
