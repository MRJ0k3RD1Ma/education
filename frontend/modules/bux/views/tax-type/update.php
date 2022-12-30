<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TaxType $model */

$this->title = 'Update Tax Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tax Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tax-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
