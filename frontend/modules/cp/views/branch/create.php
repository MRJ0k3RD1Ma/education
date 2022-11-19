<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Branch $model */

$this->title = 'Filial qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Filiallar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-create">


    <div class="card">
        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>


</div>
