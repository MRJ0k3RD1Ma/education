<?php

use common\models\Tax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\TaxSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Taxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-index">


    <div class="card">
        <div class="card-body">

            <p style="text-align: right">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCreate" aria-controls="offcanvasCreate"><span class="fa fa-plus"></span> Qo'shish</button>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="fa fa-search"></span> Qidiruv</button>

            </p>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
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
            [
                'attribute'=>'file',
                'value'=>function($d){
                    return "<a href='/uploads/tax/{$d->file}'>Yuklab oling</a>";
                },
                'format'=>'raw'
            ],
            'ads:ntext',
//            'creator_id',
            [
                'attribute'=>'creator_id',
                'value'=>function($d){return $d->creator->name;}
            ],
            [
                'attribute'=>'confirm_id',
                'value'=>function($d){return @$d->confirm->name;}
            ],
//            'confirm_id',
//            'created',
            [
                'attribute'=>'status',
                'value'=>function($d){return Yii::$app->params['status_tax'][$d->status]; }
            ],
            'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tax $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
        </div>
    </div>

</div>
