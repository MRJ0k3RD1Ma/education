<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

?>
<div class="row">
    <div class="col-xl-3">
        <div class="card h-100">
            <div class="card-body email-leftbar">
                <div class="d-grid">
                    <a href="email-compose.html" class="btn btn-danger btn-rounded waves-effect waves-light"><i class="mdi mdi-plus me-1"></i> Compose</a>
                </div>


                <?= $this->render('_search',['model'=>$searchModel])?>

            </div>
        </div>
    </div>

    <div class="col-xl-9">
        <div class="row">
            <div class="col-md-7">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group me-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                    </div>
                    <div class="btn-group me-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div>

                    <div class="btn-group ms-2 mb-3">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#custom-primary" role="tab">
                            <i class="mdi mdi-inbox me-2 align-middle font-size-18"></i> <span class="d-none d-md-inline-block">Primary</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#custom-social" role="tab">
                            <i class="mdi mdi-account-group-outline me-2 align-middle font-size-18"></i> <span class="d-none d-md-inline-block"> Social</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#custom-promotion" role="tab">
                            <i class="mdi mdi-tag-multiple me-2 align-middle font-size-18"></i> <span class="d-none d-md-inline-block">Promotion</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-3">
                    <div class="tab-pane active" id="custom-primary" role="tabpanel">
                        <ul class="message-list mb-0">
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'layout'=>'{summary} {items}',
                                'itemOptions' => ['class' => 'item'],
                                'itemView' => '_list',
                            ]) ?>
                        </ul>
                    </div>


            </div>
        </div>

            <?php echo LinkPager::widget([
                'pagination' => $dataProvider->getPagination(),
            ]); ?>
        <!-- end card -->
    </div>
</div>
<!-- end row -->
