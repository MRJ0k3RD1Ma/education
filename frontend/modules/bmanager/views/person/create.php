<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Person $model */

$this->title = 'O`quvchi qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'O`quvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">


    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'wish'=>$wish,
                'analitics'=>$analitics
            ]) ?>
        </div>
    </div>

</div>
