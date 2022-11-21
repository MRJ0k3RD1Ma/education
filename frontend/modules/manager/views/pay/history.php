<?php

use common\models\Pay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pay', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'student_id',
            'payment_id',
            'price',
            //'pay_date',
            //'branch_id',
            //'user_id',
            //'created',
            //'updated',
            //'status_id',
            //'consept_id',
            //'check_file',
            //'ads:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pay $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
