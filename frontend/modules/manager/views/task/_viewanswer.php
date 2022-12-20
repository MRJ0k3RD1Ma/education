<?php
/* @var $model \common\models\TaskAnswer*/
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title" style="background: #f1f5f7; padding:10px 5px"><?= $model->status->icon ?> <?= $model->status->name?></h4>
        <?php
            if($model->status_id > 2){?>
                <?= $model->confirm->name ?>
                <p class="card-title-desc"><b>Izoh: <?= $model->comment ?></b></p>
            <?php } ?>
        <hr>
        <p class="card-title-desc"><?= $model->detail?></p>
        <div class="row">
            <?php foreach (\common\models\TaskAnswerFile::find()->where(['task_id'=>$model->task_id,'user_id'=>$model->user_id,'ans_id'=>$model->id])->all() as $item): ?>
                <div class="col-md-6 col-6">
                    <div class="card">
                        <div class="py-2 text-center">
                            <a href="/uploads/task_answer/<?= $item->file ?>" class="fw-medium">Yuklab olish</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr>
        <?php if($model->status_id <= 2){?>
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn btn-danger">Javobni qaytarib olish</a>
            </div>
        </div>
        <?php }?>
    </div>
</div>