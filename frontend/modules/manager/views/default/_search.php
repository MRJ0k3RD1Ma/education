<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\StudentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-search">


    <div class="row">
        <div class="col-md-6">
            <h4><?= $this->title?></h4>
        </div>
        <div class="col-md-6" style="text-align: right">

            <a href="#" class="btn btn-info"><span class="fa fa-file-excel"></span> Export</a>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="fa fa-search"></span> Qidiruv</button>
        </div>
    </div>

    <br>



</div>
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
            'method' => 'get',
        ]); ?>
        <?= $form->field($model, 'code') ?>

        <?php echo $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\StudentPayStatus::find()->all(),'id','name'),['prompt'=>'']) ?>

        <?php echo $form->field($model, 'course')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Cource::find()->all(),'id','name'),['prompt'=>''])->label('Kurs nomi') ?>
        <?php echo $form->field($model, 'group')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Groups::find()->where(['course_id'=>$model->course])->all(),'id','name'),['prompt'=>''])->label('Kurs nomi') ?>

        <br>
        <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
