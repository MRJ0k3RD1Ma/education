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

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(\common\models\Project::find()->where(['status'=>1])->all(),'id','name')) ?>

    <?php if($model->group->type_id == 2){?>

        <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\common\models\WorkType::find()->all(),'id','name')) ?>

    <?php }else{ ?>

        <?= $form->field($model, 'social_id')->dropDownList(ArrayHelper::map(\common\models\PersonSocial::find()->all(),'id','name')) ?>

        <?= $form->field($model, 'student_social_id')->dropDownList(ArrayHelper::map(\common\models\StudentSocial::find()->all(),'id','name')) ?>

    <?php } ?>


    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
