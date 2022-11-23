<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Student $student */
/** @var common\models\StudentPay $model */
/** @var yii\widgets\ActiveForm $form */
$this->title = $student->person->name.' nomidan to`lov qabul qilish';
$this->params['breadcrumbs'][] = ['label' => 'Guruhlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $student->group->name, 'url' => ['view','id'=>$student->group_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="groups-form">

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'code')->textInput(['disabled'=>true]) ?>

            <?= $form->field($model, 'price')->textInput(['disabled'=>true]) ?>

            <?= $form->field($model, 'paid_date')->textInput(['type'=>'date']) ?>

            <?= $form->field($model, 'payment_id')->dropDownList(ArrayHelper::map(\common\models\Payment::find()->all(),'id','name')) ?>
            <br>
            <?= $form->field($model, 'check_file')->fileInput() ?>

            <?= $form->field($model, 'ads')->textInput() ?>

            <br>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
