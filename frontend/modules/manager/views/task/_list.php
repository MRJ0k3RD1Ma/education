
<li>
    <div class="col-mail col-mail-1">
        <a href="<?= Yii::$app->urlManager->createUrl(['/manager/task/view','id'=>$model->id])?>" class="title"><?= $model->code?></a>
    </div>
    <div class="col-mail col-mail-2">
        <a href="<?= Yii::$app->urlManager->createUrl(['/manager/task/view','id'=>$model->id])?>" class="subject">
            <?= date('d-M, y',strtotime($model->created)) ?>
            <span class="<?= $model->status->icon ?> badge me-2"><?= $model->status->name ?></span>
            <?= $model->name ?>
        </a>
        <div class="date"><?= date('d-M, y',strtotime($model->deadline)) ?></div>
    </div>
</li>
