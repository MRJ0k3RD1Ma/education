<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/'])?>" class="waves-effect">
                    <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/person'])?>" class="waves-effect">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Registratura</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>O'quvchilar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/student'])?>">O`quvchilar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/student/done'])?>">O`qishni tugatganlar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>To`lovlar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/default/pay'])?>">Tasdiqlanishi kutilayotgan</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/default/allpay'])?>">Barcha to`lovlar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/groups'])?>" class="waves-effect">
                        <i class="mdi mdi-bag-personal fs-3"></i>
                        <span>Guruhlar</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/room'])?>" class="waves-effect">
                        <i class="mdi mdi-door fs-3"></i>
                        <span>Xonalar ro`yhati</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/user'])?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple fs-3"></i>
                        <span>O'qituvchilar</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/user'])?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple fs-3"></i>
                        <span>O'qituvchilar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>Topshiriqlar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/task/answers'])?>">Javoblar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/task'])?>">Topshiriqlar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bmanager/task/create'])?>">Yangi topshiriq</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['#'])?>">Nazorat</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
