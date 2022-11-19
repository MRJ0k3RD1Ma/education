<?php

use common\models\Branch;
use common\models\UserRole;
use common\models\UserType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->all(),'id','name'),['prompt'=>'Filialni tanlang']) ?>

    <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(UserRole::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['status']) ?>

    <?= $form->field($model, 'state')->dropDownList(Yii::$app->params['state']) ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(UserType::find()->all(),'id','name')) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
