<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TaxUsual $model */

$this->title = 'Update Tax Usual: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tax Usuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tax-usual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
