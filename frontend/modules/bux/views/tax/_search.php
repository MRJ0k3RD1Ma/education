<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\TaxSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tax-search">
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


    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TaxType::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'tax') ?>

    <?= $form->field($model, 'tax_bank') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php echo $form->field($model, 'ads') ?>

    <?php echo $form->field($model, 'creator_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where('role_id in (3,4)')->all(),'id','name')) ?>

    <?php echo $form->field($model, 'confirm_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where('role_id in (3,4)')->all(),'id','name')) ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>
            <br>
    <div class="form-group">
        <?= Html::submitButton('Qidiruv', ['class' => 'btn btn-primary']) ?>
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

            <?= $this->render('_form',['model'=>new \common\models\Tax()])?>

        </div>
    </div>

</div>
