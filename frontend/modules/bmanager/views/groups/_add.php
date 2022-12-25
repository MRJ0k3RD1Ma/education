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

    <h4 class="text text-primary"><?= $model->person->name; ?></h4>
    <hr>
    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(\common\models\Project::find()->where(['status'=>1])->all(),'id','name')) ?>

    <?php if($model->group->type_id == 2){?>

        <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\common\models\WorkType::find()->all(),'id','name')) ?>

    <?php }else{ ?>

        <?= $form->field($model, 'social_id')->dropDownList(ArrayHelper::map(\common\models\PersonSocial::find()->all(),'id','name')) ?>

        <?= $form->field($model, 'student_social_id')->dropDownList(ArrayHelper::map(\common\models\StudentSocial::find()->all(),'id','name')) ?>

    <?php } ?>
    <br>
    <?= $form->field($model,'has_discount')->checkbox(['value'=>'1'])?>

    <div id="discount" style="display: none">
        <?= $form->field($model,'discount')->dropDownList(Yii::$app->params['discount'])?>
        <br>
        <?= $form->field($model,'discount_file')->fileInput()?>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
    $this->registerJs("
        $('#student-has_discount').change(function(){
            if($('#student-has_discount').is(':checked')){
                $('#discount').css('display','block');
            }else{
                $('#discount').css('display','none');                
            }
        })
    ")
?>