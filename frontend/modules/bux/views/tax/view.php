<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tax $model */

$this->title = $model->type->name;
$this->params['breadcrumbs'][] = ['label' => 'Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tax-view">

    <div class="card">
        <div class="card-body">
            <p>
                <?php if($model->status == 0 ){?>
                <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="fa fa-check"></span> To`lovni tasdiqlash</button>
                <?php }?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

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
                    [
                        'attribute'=>'status',
                        'value'=>function($d){return Yii::$app->params['status_tax'][$d->status]; }
                    ],
            'created',
                    'updated',

                ],
            ]) ?>
        </div>
    </div>


</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
     aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">To`lovni tasdiqlash</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <?= $this->render('_confirm',['model'=>$model])?>

    </div>

</div>