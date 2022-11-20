<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Person $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'O`quvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="person-view">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'pnfl',
                            'inn',
                            'birthday',
                            'phone',
                            'phone_parent',
                            'created',
                            'updated',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <p>
                        <?= Html::a('Kurs qo`shish', ['add', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    </p>
                    <h4>Kurslar ro'yhati</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kurs nomi</th>
                                    <th>Kunlari</th>
                                    <th>Vaqt</th>
                                    <th>Kiritildi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $n=0; foreach ($model->course as $item): $n++;?>
                                <tr>
                                    <td><?= $n?></td>
                                    <td><?= $item->course->name ?></td>
                                    <td><?= $item->day->name ?></td>
                                    <td><?= $item->time ?></td>
                                    <td><?= date('d.m.Y',strtotime($item->created)) ?></td>
                                    <td><button value="<?= Yii::$app->urlManager->createUrl(['/manager/person/delwish','person_id'=>$item->person_id,'course_id'=>$item->course_id]) ?>"
                                                class="btn btn-danger deletewish"><span class="fa fa-trash"></span></button></td>
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


<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"  id="deletewish" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kursni o'chirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
    $this->registerJs("
        $('.deletewish').click(function(){
            var url = this.value;
            
//            $('#deletewish').modal('show');
            $('#deletewish').modal('show').find('#deletewish .modal-body').load(url);
        })
    ")
?>