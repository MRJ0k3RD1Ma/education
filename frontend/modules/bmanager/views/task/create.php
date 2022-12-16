<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Topshiriq kiritish';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="task-form">


            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                    <h4>Topshiriq ma`lumotlari</h4>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'deadline')->textInput(['type'=>'date']) ?>

                    <br>
                    <?= $form->field($model,'files')->fileInput() ?>
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
                            <button class="btn btn-primary" id="addmore" type="button"><span class="fa fa-plus"></span> Yana qo`shish</button>
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
            $.get('{$url}').done(function(data){
                $('#executors').append(data);
            })
        })
    ")

?>