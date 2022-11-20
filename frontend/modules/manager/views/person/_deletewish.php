<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PersonWish $model */
/** @var common\models\PersonWishHistory $wish */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="person-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($wish, 'ads')->textInput(['maxlength' => true]) ?>

        <br>
        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
