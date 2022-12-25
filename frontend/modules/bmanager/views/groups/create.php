<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Groups $model */

$this->title = 'Guruh qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Guruhlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
