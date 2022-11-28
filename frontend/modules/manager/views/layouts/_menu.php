<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/'])?>" class="waves-effect">
                    <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/person'])?>" class="waves-effect">
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
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/manager/student'])?>">O`quvchilar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/manager/student/done'])?>">O`qishni tugatganlar</a></li>
                    </ul>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/default/pay'])?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i>
                        <span>To'lovlar</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/groups'])?>" class="waves-effect">
                        <i class="mdi mdi-bag-personal fs-3"></i>
                        <span>Guruhlar</span>
                    </a>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/room'])?>" class="waves-effect">
                        <i class="mdi mdi-door fs-3"></i>
                        <span>Xonalar ro`yhati</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/user'])?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple fs-3"></i>
                        <span>O'qituvchilar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>Statistikalar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/manager/default/stat'])?>">Kurslar kesimida</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/manager/default/statstudent'])?>">O'quvchilar kesimida</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
