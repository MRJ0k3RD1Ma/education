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

            <p>
                <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?php if($model->status_id == 1){?>
                    <button class="btn btn-info start" value="<?= Yii::$app->urlManager->createUrl(['/manager/groups/start','id'=>$model->id])?>">Guruhga start berish</button>
                <?php }elseif($model->status_id == 2){?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/groups/stop','id'=>$model->id])?>" data-method="post" class="btn btn-info" data-confirm="Siz rostdan ham ushbu guruh o`qishni tugatganligini tasdiqlaysizmi?">Guruh o`qishini tugatdi</a>
                <?php }?>
            </p>

            <div class="row">
                <div class="col-md-<?= $model->status_id == 1?'6':'12'?>">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label'=>'Guruh nomi',
                                'attribute'=>'name',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/manager/groups/view','id'=>$d->id]);
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
                <?php if($model->status_id == 1){?>
                    <div class="col-md-6">
                        <h4>Ushbu kursga mos kelgan o'quvchilar</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>FIO</th>
                                    <th>Telefon</th>
                                    <th>Istagi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $n=0; foreach ($model->wish as $item): $n++?>
                                    <tr>
                                        <td><button class="add btn btn-primary" value="<?= Yii::$app->urlManager->createUrl(['/manager/groups/add','id'=>$model->id,'person_id'=>$item->person_id,'course_id'=>$item->course_id])?>"><span class="fa fa-plus"></span> </button></td>
                                        <td><?= $n?></td>
                                        <td><a href="<?= Yii::$app->urlManager->createUrl(['/manager/person/view','id'=>$item->person_id])?>"><?= $item->person->name ?></a></td>
                                        <td><?= $item->person->phone ?></td>
                                        <td><?= $item->day->name.'<br>'.$item->time ?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php }?>
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
                                <th>To`lov holati</th>
                                <?php if($model->status_id != 1){?><th>Status</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $n=0; foreach ($model->students as $item): $n++?>
                                <tr>
                                    <td><button class="btn btn-link paying" value="<?= Yii::$app->urlManager->createUrl(['/manager/groups/paying','id'=>$item->id])?>"><?= $item->code; ?></button></td>
                                    <td><a target="_blank" href="<?= Yii::$app->urlManager->createUrl(['/manager/person/view','id'=>$item->person_id])?>"><?= $item->person->name ?></a></td>
                                    <td><?= $item->person->phone?></td>
                                    <td><?= $item->person->phone_parent?></td>
                                    <td><?= $item->social->name ?></td>
                                    <td><?= $item->project->name ?></td>
                                    <td><?= $item->created ?></td>
                                    <td>
                                    <?php if($model->status_id == 1){?>
                                        Kurs boshlanmagan
                                    <?php }else{
                                        $time = strtotime("Y-m-d");
                                        $time = date("Y-m-d", strtotime($time."+5 days"));
                                        $time = date("Y-m-d", strtotime($time."+1 month"));
                                        if($pay = \common\models\StudentPay::find()->where(['student_id'=>$item->id])
                                            ->andWhere(['<','pay_date',$time])->orderBy(['pay_date'=>SORT_DESC])->one()){echo $pay->status->name;}else{
                                            ?>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['/manager/groups/payregenerate','id'=>$item->id])?>">To`lovni qayta generatsiya qilish</a>
                                                <?php }?>

                                    <?php }?>
                                    </td>
                                    <?php if($model->status_id != 1){?><td><?= Yii::$app->params['status_student'][$item->status] ?></td><?php }?>
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
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"  id="add" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">O`quvchini kursga qo`shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body add">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="start" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Guruhga kursga start berish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body start">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="paying" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">To'lovni qabul qilish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body paying-modal">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php

$this->registerJs("

    $('.add').click(function(){
        var url = this.value;
        $('#add').modal('show').find('.add.modal-body').load(url); 
    });
    
    
    $('.start').click(function(){
        var url = this.value;
        $('#start').modal('show').find('.start.modal-body').load(url); 
    });
    
    
     $('.paying').click(function(){
        var url = this.value;
        $('#paying').modal('show').find('.paying-modal.modal-body').load(url); 
    });
    
")
?>