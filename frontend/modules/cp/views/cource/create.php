<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cource $model */

$this->title = 'Kurs qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Kurslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cource-create">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>
