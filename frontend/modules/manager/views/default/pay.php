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

            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>




            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,

                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],


                    [
                        'attribute'=>'code',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/manager/default/view','id'=>$d->id,'student_id'=>$d->student_id]);
                            return "<a href='{$url}'>{$d->code}</a>";
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'student_id',
                        'value'=>function($d){return $d->student->person->name;},
                        'filter'=>false
                    ],
//                    'pay_date',
                    [
                        'attribute'=>'pay_date',
                        'filter'=>false
                    ],
                    [
                        'attribute'=>'price',
                        'filter'=>false
                    ],
                    [
                        'attribute'=>'paid_date',
                        'filter'=>false
                    ],
                    [
                        'attribute'=>'payment_id',
                        'value'=>function($d){return @$d->payment->name;},
                        'filter'=>false
                    ],

                    //'consept_id',
//                    'check_file',
                    [
                        'attribute'=>'check_file',
                        'value'=>function($d){
                            if($d->status_id == 1 or $d->status_id == 5){
                                $url = Yii::$app->urlManager->createUrl(['/manager/default/paysend','student_id'=>$d->student_id,'id'=>$d->id,'type'=>1]);
                                return "<a href='{$url}'>To`lovni kiritish</a>";
                            }
                            if($d->check_file){
                                $url = "/uploads/check/".$d->check_file;
                                return "<a target='_blank' href='{$url}'>Chekni ko`rish</a>";
                            }
                            return null;
                        },
                        'format'=>'raw',
                        'filter'=>false
                    ],
                    [
                        'attribute'=>'ads',
                        'format'=>'ntext',
                        'filter'=>false
                    ],
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
