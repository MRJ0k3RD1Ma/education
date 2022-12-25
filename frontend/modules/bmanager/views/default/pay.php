<?php

use common\models\StudentPay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\StudentPaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'To`lovlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-pay-index">

    <div class="card">
        <div class="card-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'code',
//                    'student_id',
                    [
                        'attribute'=>'code',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/bmanager/default/view','id'=>$d->id,'student_id'=>$d->student_id]);
                            return "<a href='{$url}'>{$d->code}</a>";
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'student_id',
                        'value'=>function($d){return $d->student->person->name;},
                        'filter'=>false
                    ],
//                    'id',
//                    'pay_date',

                    'price',
                    'paid_date',
//                    'payment_id',
                    [
                        'attribute'=>'payment_id',
                        'value'=>function($d){return @$d->payment->name;},
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->all(),'id','name')
                    ],
//                    'branch_id',
                    [
                        'attribute'=>'branch_id',
                        'value'=>function($d){
                            return @$d->branch->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Branch::find()->all(),'id','name')
                    ],
//                    'user_id',
                    [
                        'attribute'=>'user_id',
                        'value'=>function($d){return @$d->user->name; },
                        'filter'=>false,
                    ],
                    //'consept_id',
//                    'check_file',
                    [
                        'attribute'=>'check_file',
                        'value'=>function($d){
                            $url = "/uploads/check/".$d->check_file;
                            return "<a target='_blank' href='{$url}'>Chekni ko`rish</a>";
                        },
                        'format'=>'raw',
                        'filter'=>false
                    ],
                    'ads:ntext',
//                    'status_id',
                    [
                        'attribute'=>'status_id',
                        'value'=>function($d){
                            return $d->status->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\StudentPayStatus::find()->all(),'id','name')
                    ],
                    //'created',
                    //'updated',

                ],
            ]); ?>
        </div>
    </div>


</div>
