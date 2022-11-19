<?php

use common\models\Groups;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\GroupsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Guruhlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <div class="card">
        <div class="card-body">

            <p>
                <?= Html::a('Guruh qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'branch_id',
                    'course_id',
                    'status_id',
                    //'start_date',
                    //'day_id',
                    //'time',
                    //'type_id',
                    //'price',
                    //'created',
                    //'updated',
                    //'creator_id',
                    //'room_id',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Groups $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
