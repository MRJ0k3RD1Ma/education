<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TaxType $model */

$this->title = 'Create Tax Type';
$this->params['breadcrumbs'][] = ['label' => 'Tax Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
