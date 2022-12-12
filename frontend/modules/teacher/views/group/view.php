<?php

use common\models\Attendance;
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
            <p style="text-align: right">
                <?php if($status == 0){?>
                    <a href="<?= Yii::$app->request->url ?>&start=1" class="btn btn-primary">Darsni boshlash</a>
                <?php }elseif($status==1){ ?>
                    <a href="<?= Yii::$app->request->url ?>&stop=1" class="btn btn-primary">Darsni yakunlash</a>
                <?php }else{ ?>
                    <span class="btn btn-success">Bugungi dars yakunlangan</span>
                <?php }?>
            </p>
            <div class="row">
                <div class="col-md-8">
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

                        ],
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <h4>O'tilgan darslar ro'yhati</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sana</th>
                                    <th>O'qituvchi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=0; foreach (\common\models\GroupClass::find()->where(['group_id'=>$model->id])->all() as $item): $n++?>
                                    <tr>
                                        <td><?= $n;?></td>
                                        <td><?= $item->date_class ;?></td>
                                        <td><?= $item->teacher->name ;?></td>

                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Ushbu guruhga yozilgan o`quvchilar ro`yhati</h4>
                    <?php $form = \yii\widgets\ActiveForm::begin()?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <?php if($status==1){?>
                                    <th></th>
                                <?php }?>
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
                                    <?php if($status==1){?>
                                        <td><?= $form->field($model,'student_id['.$item->id.']')->checkbox(['value'=>1,'checked'=>
                                                Attendance::find()->where(['group_id'=>$model->id])->andWhere(['teacher_id'=>Yii::$app->user->id])->andWhere(['date_class'=>date('Y-m-d')])
                                                    ->andWhere(['student_id'=>$item->id])->one()->status == 0 ? false : true
                                            ])->label(false) ?></td>
                                    <?php }?>
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

                    <?php if($status==1){?>
                        <button class="btn btn-success">Davomatni saqlash</button>
                    <?php }?>
                    <?php \yii\widgets\ActiveForm::end()?>


                </div>
            </div>


        </div>
    </div>

</div>
