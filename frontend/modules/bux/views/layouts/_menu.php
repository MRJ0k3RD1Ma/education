<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bux/'])?>" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/bux/default/pay'])?>" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i>
                        <span>To'lovlar </span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>Harajatlar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bux/tax'])?>">Harajatlar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bux/tax-usual'])?>">Doimiy harajatlar</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/bux/tax-type'])?>">Harajat turlari</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
