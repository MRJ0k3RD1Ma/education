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
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/student'])?>" class="waves-effect">
                    <i class="fa fa-users" aria-hidden="true"></i>
                        <span>O`quvchilar</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/manager/pay'])?>" class="waves-effect">
                    <i class="mdi mdi-currency-usd  fs-3 " ></i>
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


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
