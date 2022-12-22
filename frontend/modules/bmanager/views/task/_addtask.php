<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */


$task = new \common\models\TaskUser();
?>

<div class="task-form">


            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'action'=>Yii::$app->urlManager->createUrl(['/bmanager/task/addtask','id'=>$model->id])]); ?>

            <?= $form->field($task,'exec_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['<>','role_id','1'])->andWhere(['status'=>1,'state'=>1])->all(),'id','name'))?>
            <?= $form->field($task,'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TaskType::find()->all(),'id','name'))?>
            <?= $form->field($task,'deadline')->textInput(['type'=>'date'])?>
            <br>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>


</div>