<?php

use common\models\Person;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PersonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'O`quvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <div class="card">
        <div class="card-body">
            <p style="text-align: right">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="fa fa-search"></span> Qidiruv</button>
            </p>

            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'name',
                    [
                        'attribute'=>'name',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/bmanager/person/view','id'=>$d->id]);
                            return "<a href='{$url}'>{$d->name}</a>";
                        },
                        'format'=>'raw'
                    ],
                    'pnfl',
                    'inn',
                    'birthday',
                    'phone',
                    'phone_parent',
                    'created',
                    //'updated',
                ],
            ]); ?>
        </div>
    </div>

</div>
