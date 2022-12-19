<?php
/* @var $model \common\models\Task */
?>

<div class="row mb-4">
    <div class="col-xl-3">
        <div class="card h-100">
            <div class="card-body email-leftbar">
                <div class="d-grid">
                    <a href="email-compose.html" class="btn btn-danger btn-rounded waves-effect waves-light"><i
                                class="mdi mdi-plus me-1"></i> Compose</a>
                </div>

            </div>
        </div>
    </div>

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
                        <h4 class="font-size-16"><?= Yii::$app->user->identity->name ?></h4>
                        <p class="text-muted font-size-13"><?= Yii::$app->user->identity->role->name ?></p>
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

                <a href="#" class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i> Topshiriqni
                    tugatish</a>
            </div>
        </div>
        <!-- end card -->

        <div class="mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center activity">
                        <div><i class="fa fa-clock-o"></i><span class="ml-2">11h 25m</span></div>
                        <div><span class="activity-done">Done Activities(4)</span></div>
                        <div class="icons"><i class="fa fa-search"></i><i class="fa fa-ellipsis-h"></i></div>
                    </div>
                    <div class="mt-3">
                        <ul class="list list-inline">
                            <?php
                            foreach ($model->taskUsers as $item):
                                ?>
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i
                                                class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2">
                                            <h6 class="mb-0"><?= $item->exec->name ?></h6>
                                            <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                <div><i class="fa fa-calendar"></i><span
                                                            class="ml-2"><?= $item->created?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="d-flex flex-column mr-2">
                                            <div class="profile-image">
                                                <a href="#"><span class="fa fa-check"></span></a>
                                            </div>
                                            <span class="date-time"><?= $item->deadline?></span></div>
                                        <i class="fa fa-ellipsis-h"></i>
                                    </div>
                                </li>
                            <?php endforeach;?>

                        </ul>
                    </div>
                </div>
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

    .checkicon {
        color: green;
        font-size: 19px;
    }

    .date-time {
        font-size: 12px;
    }

    .profile-image img {
        margin-left: 3px;
    }
</style>