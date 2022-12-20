<?php
/* @var $model \common\models\Task */
?>

<div class="row mb-4">


    <div class="col-xl-9">
        <div class="row">
            <div class="col-md-7">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group me-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-inbox"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="far fa-trash-alt"></i></button>
                    </div>
                    <div class="btn-group me-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="btn-toolbar justify-content-md-end" role="toolbar">
                    <div class="btn-group ms-md-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div>

                    <div class="btn-group ms-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            More <i class="mdi mdi-dots-vertical ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Mark as Unread</a>
                            <a class="dropdown-item" href="#">Mark as Important</a>
                            <a class="dropdown-item" href="#">Add to Tasks</a>
                            <a class="dropdown-item" href="#">Add Star</a>
                            <a class="dropdown-item" href="#">Mute</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex mb-4">
                    <div class="flex-grow-1">
                        <h4 class="font-size-16"><?= $model->user->name ?></h4>
                        <p class="text-muted font-size-13"><?= $model->user->role->name ?></p>
                    </div>
                </div>
                <h4 class="font-size-16"><?= $model->name ?></h4>
                <p>
                    <?= $model->detail ?>
                </p>
                <hr/>

                <div class="row">
                    <?php foreach ($model->taskFiles as $item): ?>
                        <div class="col-xl-2 col-6">
                            <div class="card">
                                <div class="py-2 text-center">
                                    <a href="/uploads/task/<?= $item->file ?>" class="fw-medium">Yuklab olish</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <!-- end card -->

    </div>

    <div class="col-xl-3">
        <div class="card h-100">
            <div class="card-body email-leftbar">
                <?php if($model->status_id != 4){?>
                <div class="d-grid">
                    <button value="<?= Yii::$app->urlManager->createUrl(['/manager/task/answer','id'=>$model->id])?>" class="btn btn-danger btn-rounded waves-effect waves-light answer">
                        <i class="mdi mdi-plus me-1"></i> Javob kiritish
                    </button>
                </div>
                <?php }?>
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0"> Berilgan javoblar </h6>
                        </div>
                    </div>
                </div>

                <?php foreach (\common\models\TaskAnswer::find()->where(['task_id'=>$model->id,'user_id'=>Yii::$app->user->id])->orderBy(['id'=>SORT_DESC])->all() as $item):?>
                    <a class="text-reset notification-item answer_list" data-url="<?= Yii::$app->urlManager->createUrl(['/manager/task/viewanswer','id'=>$item->id,'task_id'=>$model->id])?>">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <span class="avatar-title rounded-circle font-size-16">
                                        <?= $item->status->icon?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1"><?= mb_substr($item->comment,0,26)?>...</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1"><?= mb_substr($item->detail,0,100)?>...</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= $item->created ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach;?>

            </div>
        </div>
    </div>
</div>
<!-- end row -->

<style>
    .icons i {
        color: #b5b3b3;
        border: 1px solid #b5b3b3;
        padding: 6px;
        margin-left: 4px;
        border-radius: 5px;
        cursor: pointer;
    }

    .activity-done {
        font-weight: 600;
    }

    .list-group li {
        margin-bottom: 12px;
    }

    .list li {
        list-style: none;
        padding: 10px;
        border: 1px solid #e3dada;
        margin-top: 12px;
        border-radius: 5px;
        background: #fff;
    }

    .checkicon i.fa:first-child {
        font-size: 19px; margin-right: 10px;
    }

    .date-time {
        font-size: 12px;
    }

    .profile-image img {
        margin-left: 3px;
    }
</style>

    <!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="answeroff"
         aria-labelledby="offcanvasCreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Topshiriqga javob yuborish</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body answeroff">


        </div>
    </div>

<!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="viewanswer"
         aria-labelledby="offcanvasCreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Javob ma`lumotlari</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body viewanswer">


        </div>
    </div>


<?php
$this->registerJs("
    $('.answer').click(function(){
        var url = this.value;
        $('#answeroff').offcanvas('show').find('.answeroff.offcanvas-body').load(url); 
    });
    
    $('.answer_list').click(function(){
        var url = $(this).attr('data-url');
        $('#viewanswer').offcanvas('show').find('.viewanswer.offcanvas-body').load(url); 
    })
")
?>


