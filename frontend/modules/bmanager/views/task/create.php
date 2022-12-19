<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Topshiriq kiritish';
$this->params['breadcrumbs'][] = ['label' => 'Topshiriqlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="task-form">


            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                    <h4>Topshiriq ma`lumotlari</h4>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'deadline')->textInput(['type'=>'date']) ?>

                    <br>
                    <div id="file" class="row">

                    </div>

                            <br>
                            <button type="button" class="btn btn-primary" id="fileadd"><span class="fa fa-plus"></span>Fayl qo`shish</button>

                </div>
            </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Topshiriqni qabul qiluvchilar</h4>
                            <div id="executors">

                            </div>
                            <br>
                            <button class="btn btn-primary" id="addmore" value="1" type="button"><span class="fa fa-plus"></span> Yana qo`shish</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>


</div>


<?php
    $url = Yii::$app->urlManager->createUrl(['/bmanager/task/getexec']);
    $this->registerJs("
        $('#addmore').click(function(){
            $.get('{$url}?key='+$('#addmore').val()).done(function(data){
                var val = $('#addmore').val();
                val ++;
                $('#addmore').val(val)
                $('#executors').append(data);
            })
        })
        
        $('#fileadd').click(function(){
            var str = '<div class=\"col-md-6\"><br><div class=\"form-group field-task-files has-success\"><label class=\"control-label\" for=\"task-files\">Fayl</label><input type=\"file\" id=\"task-files\" name=\"Task[files][]\" aria-invalid=\"false\"></div></div>'
            $('#file').append(str);
        })
    ")

?>