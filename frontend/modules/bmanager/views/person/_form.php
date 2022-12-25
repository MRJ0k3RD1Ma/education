<?php

use common\models\Cource;
use common\models\GroupDay;
use common\models\Groups;
use common\models\PersonSocial;
use common\models\Project;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Person $model */
/** @var common\models\PersonWish $wish */
/** @var common\models\AnalyticsType $analitics */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-form">

    <?php if($model->isNewRecord){
        $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/manager/person/create'])]);
    }else{
        $form = ActiveForm::begin();
    } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord){?>
    <?= $form->field($model, 'pnfl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?php } ?>

    <?= $form->field($model, 'gender')->dropDownList([0=>'Ayol',1=>'Erkak'],['prompt'=>'Jinsini tanlang']) ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true,'type'=>'date']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_parent')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord){ ?>
    <?= $form->field($model,'checked')->checkbox(['value'=>1]) ?>

    <div id="checked" style="display: none">
        <?= $form->field($wish,'course_id')->dropDownList(ArrayHelper::map(Cource::find()->all(),'id','name')) ?>
        <?= $form->field($wish,'day_id')->dropDownList(ArrayHelper::map(GroupDay::find()->all(),'id','name')) ?>
        <?= $form->field($wish,'time')->dropDownList(Yii::$app->params['times']) ?>

    </div>
        <br>
        <?php foreach ($analitics as $item):?>
            <?= $form->field($model,'analitics['.$item->id.']')->checkbox(['value'=>1])->label($item->name)?>
        <?php endforeach; ?>
    <?php } ?>


    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs("
     $('#person-checked').change(function() {
        if(this.checked) {
            $('#checked').css('display','block');
        } else{
            $('#checked').css('display','none');
        }
    });
")
?>