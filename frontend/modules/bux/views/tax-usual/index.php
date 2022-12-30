<?php

use common\models\TaxUsual;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\TaxUsualSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tax Usuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-usual-index">


    <div class="card">
        <div class="card-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],


//            'id',
//            'type_id',
                    [
                        'attribute'=>'type_id',
                        'value'=>function($d){
                            return $d->type->name;
                        }
                    ],
                    'price',
                    'tax',
                    'tax_bank',
                    //'file',

                    'ads:ntext',
//            'creator_id',
                    [
                        'attribute'=>'creator_id',
                        'value'=>function($d){return $d->creator->name;}
                    ],
                    'updated',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, TaxUsual $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
