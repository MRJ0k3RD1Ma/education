<?php

use common\models\Branch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BranchSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Filiallar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <div class="card">
        <div class="card-body">

            <p>
                <?= Html::a('Filial qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="table-responsive">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'id',
                        'code',
//                        'name',
                        [
                            'attribute'=>'name',
                            'value'=>function($d){
                                $url = Yii::$app->urlManager->createUrl(['/cp/branch/view','id'=>$d->id]);
                                return "<a href='{$url}'>{$d->name}</a>";
                            },
                            'format'=>'raw'
                        ],
                        'address',
//                        'target',
//                        'location:ntext',
                        'phone',

                        'created',
                        //'updated',
                        //'status',
                        [
                            'attribute'=>'status',
                            'value'=>function($d){
                                return @Yii::$app->params['status'][$d->status];
                            },
                            'filter'=>Yii::$app->params['status']
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Branch $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>

        </div>
    </div>





</div>
