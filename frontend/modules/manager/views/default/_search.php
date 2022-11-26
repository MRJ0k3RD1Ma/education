<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\StudentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'code') ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\StudentPayStatus::find()->all(),'id','name'),['prompt'=>'']) ?>

        </div>
        <div class="col-md-4">
            <div class="form-group" style="margin-top:29px;">
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
                <a href="#" class="btn btn-info" style="float: right"><span class="fa fa-file-excel"></span> Export</a>
            </div>
        </div>
    </div>

    <br>


    <?php ActiveForm::end(); ?>

</div>
