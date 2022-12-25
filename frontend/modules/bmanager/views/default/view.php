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
                        'value'=>function($d){return $d->payment->name;},
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
                        'value'=>function($d){return $d->user->name; },
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

            <?php if($model->status_id == 2){?>

            <a data-confirm="Siz rostdan ham ushbu to`lovni qabul qilmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/bux/default/accept','id'=>$model->id,'student_id'=>$model->student_id,'type'=>3])?>" data-method="post" class="btn btn-success">Tasdiqlash</a>

            <button class="btn btn-danger deny" value="<?= Yii::$app->urlManager->createUrl(['/bux/default/deny','id'=>$model->id,'student_id'=>$model->student_id])?>">Rad qilish</button>

            <?php }?>
        </div>
    </div>

</div>
<?php if($model->status_id == 2){?>


    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="deny" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">To`lovni rad qilish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body deny">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php

$this->registerJs("

    $('.deny').click(function(){
        var url = this.value;
        $('#deny').modal('show').find('.deny.modal-body').load(url); 
    });
    
");

}
?>


