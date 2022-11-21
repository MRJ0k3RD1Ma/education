<?php

use common\models\PersonPay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PersonPaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Person Pays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-pay-index">


    <div class="card">
        <div class="card-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],


                    [
                        'attribute'=>'code',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/manager/pay/paying','person_id'=>$d->person_id,'group_id'=>$d->group_id,'id'=>$d->id]);
                            return "<button class='btn btn-link paying' value='{$url}'>{$d->code}</button>";
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'person_id',
                        'value'=>function($d){
                            return $d->person->name;
                        },
                        'filter'=>false
                    ],
                    [
                        'attribute'=>'group_id',
                        'value'=>function($d){
                            return $d->group->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Groups::find()->all(),'id','name')
                    ],
                    'id',
                    'pay_date',
//            'status_id',

                    'price',
                    [
                        'attribute'=>'status_id',
                        'value'=>function($d){
                            return $d->status->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\PersonPayStatus::find()->all(),'id','name')
                    ],
                    //'code',
                    //'created',
                    //'updated',
                ],
            ]); ?>
        </div>
    </div>



</div>



    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"  id="paying" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">To`lov qabul qilish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php
$this->registerJs("
        $('.paying').click(function(){
            var url = this.value;
          
            $('#paying').modal('show').find('.modal-body').load(url);
        })
    ")
?>