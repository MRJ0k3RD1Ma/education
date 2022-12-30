<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tax $model */

$this->title = 'Create Tax';
$this->params['breadcrumbs'][] = ['label' => 'Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
