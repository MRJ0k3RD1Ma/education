<?php

use common\models\Pay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'To`lovlar tarixi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-index">

    <div class="card">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                    'code',
//            'student_id',
                    [
                        'attribute'=>'student_id',
                        'value'=>function($d){
                            return $d->student->person->name;
                        },
                        'filter'=>false,
                    ],
//            'payment_id',
                    [
                        'attribute'=>'payment_id',
                        'value'=>function($d){
                            return $d->payment->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->all(),'id','name')
                    ],
                    'price',
                    'pay_date',
                    //'branch_id',
                    //'user_id',
                    //'created',
                    //'updated',
//            'status_id',
                    [
                        'attribute'=>'status_id',
                        'value'=>function($d){
                            return $d->status->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\PayStatus::find()->all(),'id','name'),
                    ],
                    //'consept_id',
                    //'check_file',
                    [
                        'attribute'=>'check_file',
                        'format'=>'raw',
                        'value'=>function($d){
                            if($d->check_file){
                                $res = "<a href='/uploads/check/{$d->check_file}'>Yuklab olish</a>";
                            }else{
                                $res = null;
                            }
                            return $res;
                        },
                        'filter'=>false
                    ],
                    'ads:ntext',
                    'created'
                ],
            ]); ?>
        </div>
    </div>


</div>
