<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Student $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'code_id',
            'group_id',
            'person_id',
            'social_id',
            'project_id',
            'created',
            'updated',
            'creator_id',
            'branch_id',
            'status',
        ],
    ]) ?>

</div>
