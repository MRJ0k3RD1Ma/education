<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var common\models\Groups $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Guruhlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="groups-view">

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
//                            'id',
                            [
                                'label'=>'Guruh nomi',
                                'attribute'=>'name',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/teacher/groups/view','id'=>$d->id]);
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
//                    'status_id',
//                    'start_date',
//                    'day_id',
//                    'time',
//                    'type_id',
//                    'price',
                            'created',
                            'updated',
//                    'creator_id',
                            [
                                'attribute'=>'creator_id',
                                'value'=>function($d){
                                    return $d->creator->name;
                                },
                                'filter'=> ArrayHelper::map(\common\models\User::find()->all(),'id','name')
                            ],
//                    'room_id',
                        ],
                    ]) ?>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Ushbu guruhga yozilgan o`quvchilar ro`yhati</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>FIO</th>
                                <th>Telefon</th>
                                <th>Ota-onasining telefoni</th>
                                <th>Ijtimoiy mavqei</th>
                                <th>Loyiha nomi</th>
                                <th>Yaratildi</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $n=0; foreach ($model->students as $item): $n++?>
                                <tr>
                                    <td><?= $item->code; ?></td>
                                    <td><?= $item->person->name ?></td>
                                    <td><?= $item->person->phone?></td>
                                    <td><?= $item->person->phone_parent?></td>
                                    <td><?= $item->social->name ?></td>
                                    <td><?= $item->project->name ?></td>
                                    <td><?= $item->created ?></td>

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
