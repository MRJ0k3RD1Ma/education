
<li>
    <div class="col-mail col-mail-1">
        <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/task/view','id'=>$model->task_id])?>" class="title"><?= $model->task->code?></a>
    </div>
    <div class="col-mail col-mail-2">
        <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/task/view','id'=>$model->task_id])?>" class="subject">
            <?= date('d-M, y',strtotime($model->created)) ?>
            <span class="badge me-2"><?= $model->status->icon ?></span>
            <?= mb_substr($model->detail,0,100) ?>
        </a>
        <div class="date"><?= $model->user->name ?></div>
    </div>
</li>
