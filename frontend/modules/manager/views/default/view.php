<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\StudentPay $model */

$this->title = $model->code.' kodli to`lov';
$this->params['breadcrumbs'][] = ['label' => 'To`lovlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-pay-view">
    <div class="card">
        <div class="card-body">


            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute'=>'code',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/bux/default/view','id'=>$d->id,'student_id'=>$d->student_id]);
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
                                    return $d->branch->name;
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
                                    if($d->check_file){
                                        $url = "/uploads/check/".$d->check_file;
                                        return "<a target='_blank' href='{$url}'>Chekni ko`rish</a>";
                                    }
                                    return null;
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
//            'pay_date',
                            [
                                'attribute'=>'pay_date',
                                'label'=>'To`lash kerak bo`lgan sana'
                            ],
//            'consept_id',
                            [
                                'attribute'=>'consept_id',
                                'value'=>function($d){return @$d->consept->name;}
                            ],
                            'created',
                            'updated',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-6">

                    <div class="groups-form">

                        <div class="table-responsive">
                            <h4><?= $model->student->person->name ?></h4>
                            <p><?= $model->student->group->name ?> guruh uchun to'lovlar ro'yhati</p>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>To'lov sanasi</th>
                                    <th>Kodi</th>
                                    <th>Miqdori</th>
                                    <th>Holati</th>
                                    <th>To'lov</th>
                                    <th>Izoh</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $n=0;
                                $pay = \common\models\StudentPay::find()->where(['student_id'=>$model->student_id])->all();
                                foreach ($pay as $item): $n++?>
                                    <tr>
                                        <td><?= $n?></td>
                                        <td><?= $item->pay_date?></td>
                                        <td><?= $item->code ?></td>
                                        <td><?= $item->price ?></td>
                                        <td><?= $item->status->name ?></td>
                                        <td>
                                            <?php if($item->status_id == 1 or $item->status_id == 5){ ?>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/manager/default/paysend','student_id'=>$model->student_id,'id'=>$item->id,'type'=>0])?>">To'lov kiritish</a>
                                            <?php }else{?>
                                                <a href="/uploads/check/<?= $item->check_file?>" target="_blank"><?= $item->paid_date ?></a>
                                            <?php } ?>
                                        </td>
                                        <td><?= @$item->ads?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>

</div>

