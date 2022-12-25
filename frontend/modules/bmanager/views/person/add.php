<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Cource;
use common\models\GroupDay;
/** @var yii\web\View $this */
/** @var common\models\PersonWish $model */
$person = $model->person;
$this->title = $person->name.'ni yangi kursga yozish';
$this->params['breadcrumbs'][] = ['label' => 'O`quvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $person->name, 'url' => ['view', 'id' => $person->id]];
$this->params['breadcrumbs'][] = 'Yangi kursga yozish';
?>
<div class="person-update">

    <div class="card">
        <div class="card-body">

            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model,'course_id')->dropDownList(ArrayHelper::map(Cource::find()->where('id not in (select course_id from person_wish where person_id='.$model->person_id.')')->all(),'id','name')) ?>

            <?= $form->field($model,'day_id')->dropDownList(ArrayHelper::map(GroupDay::find()->all(),'id','name')) ?>

            <?= $form->field($model,'time')->dropDownList(Yii::$app->params['times']) ?>


            <br>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
