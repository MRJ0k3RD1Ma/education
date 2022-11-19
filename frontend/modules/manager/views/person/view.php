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
                                    <td><a data-method="post" data-confirm="Siz rostdan ham ushbu kursni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/manager/person/delwish','person_id'=>$item->person_id,'course_id'=>$item->course_id]) ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
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
