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

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>


    <br>
    <div id="file" class="row">

    </div>

    <br>
    <button type="button" class="btn btn-primary" id="fileadd"><span class="fa fa-plus"></span>Fayl qo`shish</button>

    <br><br>
    <div class="form-group">
        <?= Html::submitButton('Jo`natish', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJs("
        $('#fileadd').click(function(){
            var str = '<br><div class=\"form-group field-taskanswer-detail has-success\"><label class=\"control-label\" for=\"taskanswer-detail\">Fayl</label><input type=\"file\" id=\"taskanswer-detail\" name=\"TaskAnswer[files][]\" aria-invalid=\"false\"></div>'
            $('#file').append(str);
        })
    ")
?>