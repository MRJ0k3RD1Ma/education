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
                        <i class="mdi mdi-home-variant-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>



                <li class="menu-title">Layouts</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>Vertical</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Light Sidebar</a></li>
                        <li><a href="#">Compact Sidebar</a></li>
                        <li><a href="#">Icon Sidebar</a></li>
                        <li><a href="#">Boxed Layout</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/branch'])?>" class="waves-effect">
                        <i class="mdi mdi-bank"></i>
                        <span>Filiallar</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/user'])?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i>
                        <span>Foydalanuvchilar</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
