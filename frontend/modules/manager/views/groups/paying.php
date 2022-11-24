<?php


/** @var yii\web\View $this */
/** @var common\models\StudentPay $pay */
/** @var common\models\Student $student */
?>

<div class="groups-form">

   <div class="table-responsive">
       <h4><?= $student->person->name ?></h4>
       <p><?= $student->group->name ?> guruh uchun to'lovlar ro'yhati</p>
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
            <?php $n=0; foreach ($pay as $item): $n++?>
            <tr>
                <td><?= $n?></td>
                <td><?= $item->pay_date?></td>
                <td><?= $item->code ?></td>
                <td><?= $item->price ?></td>
                <td><?= $item->status->name ?></td>
                <td>
                    <?php if($item->status_id == 1 or $item->status_id == 5){ ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/manager/groups/paysend','student_id'=>$student->id,'id'=>$item->id])?>">To'lov kiritish</a>
                    <?php }else{?>
                        <a href="/uploads/check/<?= $item->check_file?>"><?= $item->paid_date ?></a>
                    <?php } ?>
                </td>
                <td><?= @$item->ads?></td>
            </tr>
            <?php endforeach;?>
           </tbody>
       </table>
   </div>

</div>
