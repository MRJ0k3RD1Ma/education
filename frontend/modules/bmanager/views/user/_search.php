<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

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

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'username') ?>

            <?php $form->field($model, 'password') ?>

            <?php $form->field($model, 'branch_id') ?>

            <?php // echo $form->field($model, 'role_id') ?>

            <?php  echo $form->field($model, 'status')->dropDownList(Yii::$app->params['status'],['prompt'=>'']) ?>

            <?php // echo $form->field($model, 'state') ?>

            <?php  echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\UserType::find()->all(),'id','name'),['prompt'=>'']) ?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


    <!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreate"
         aria-labelledby="offcanvasCreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasCreateLabel">Qidiruv</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <?= $this->render('_form',['model'=>new \common\models\User()])?>

        </div>
    </div>


</div>
