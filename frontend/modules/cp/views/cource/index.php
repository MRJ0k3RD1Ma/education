<?php

use common\models\Cource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CourceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kurslar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cource-index">

    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('Kurs qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'name',
                    'status',
                    'price',
                    'duration',
                    'created',
                    //'updated',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Cource $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
