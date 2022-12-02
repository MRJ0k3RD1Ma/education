<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\PersonSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-search">


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

            <?php  $form->field($model, 'id') ?>

            <?= $form->field($model, 'name') ?>

            <?php  $form->field($model, 'pnfl') ?>

            <?php $form->field($model, 'inn') ?>

            <?= $form->field($model, 'birthday')->textInput(['type'=>'date']) ?>

            <?php // echo $form->field($model, 'phone') ?>

            <?php // echo $form->field($model, 'phone_parent') ?>

            <?php // echo $form->field($model, 'created') ?>

            <?php // echo $form->field($model, 'updated') ?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreate"
         aria-labelledby="offcanvasCreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Qo'shish</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <?= $this->render('_form',[
                    'model'=>new \common\models\Person(),
                    'wish'=>new \common\models\PersonWish(),
                    'analitics'=>\common\models\AnalyticsType::find()->where(['status'=>1])->all()
            ])?>

        </div>
    </div>

</div>
