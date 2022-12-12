<?php

use common\models\Groups;
use yii\helpers\ArrayHelper;
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
                        'label'=>'Guruh nomi',
                        'attribute'=>'name',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/teacher/group/view','id'=>$d->id]);
                            return "<a href='{$url}'>{$d->name}<a/>";
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'course_id',
                        'value'=>function($d){
                            return $d->course->name;
                        },
                        'filter'=> ArrayHelper::map(\common\models\Cource::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'type_id',
                        'value'=>function($d){
                            return $d->type->name;
                        },
                        'filter'=> ArrayHelper::map(\common\models\GroupType::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'day_id',
                        'value'=>function($d){
                            return $d->day->name;
                        },
                        'filter'=> ArrayHelper::map(\common\models\GroupDay::find()->all(),'id','name')
                    ],

                    'time',
                    'price',
                    'start_date',
                    [
                        'attribute'=>'room_id',
                        'value'=>function($d){
                            return $d->room->name;
                        },
                        'filter'=> ArrayHelper::map(\common\models\Room::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'status_id',
                        'value'=>function($d){
                            return $d->status->name;
                        },
                        'filter'=> ArrayHelper::map(\common\models\GroupStatus::find()->all(),'id','name')
                    ],
//                    'room_id',
//                    'type_id',
//                    'branch_id',
//                    'course_id',
//                    'status_id',
                    //'start_date',
                    //'day_id',
                    //'time',
                    //'type_id',
                    //'price',
                    'created',
                    //'updated',
                    //'creator_id',
                    //'room_id',
                ],
            ]); ?>
        </div>
    </div>


</div>
