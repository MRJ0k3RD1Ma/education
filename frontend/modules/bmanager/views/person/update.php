<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Person $model */

$this->title = 'O`zgartirish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'O`quvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="person-update">

    <div class="card">
        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
