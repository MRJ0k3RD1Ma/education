<?php

use common\models\Room;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\RoomSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xonalar ro`yxati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('Xona qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'branch_id',

                    'name',
                    [
                        'attribute'=>'branch_id',
                        'value'=>function($d){
                            return $d->branch->name;
                        },
                        'filter'=>false,
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Room $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
