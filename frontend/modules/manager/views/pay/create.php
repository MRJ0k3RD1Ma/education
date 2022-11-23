<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pay $model */

$this->title = 'To`lov qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'To`lovlar tarixi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
