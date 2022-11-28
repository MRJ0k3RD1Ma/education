<?php

/* @var $monthly_person integer*/
/* @var $monthly_price integer*/
/* @var $monthly_price_5 integer*/

use frontend\components\General;

?>

<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex text-muted">
                    <div class="flex-shrink-0  me-3 align-self-center">
                        <div class="avatar-sm">
                            <div class="avatar-title bg-light rounded-circle text-secondary font-size-20">
                                <i class="ri-group-line"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 me-3 align-self-center">
                        <div id="radialchart-1" class="apex-charts" dir="ltr"></div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mb-3">
                            <?= General::PrettyNumber($monthly_person) ?> <span class="text text-muted">nafar</span>
                        </h5>
                        <p class="text-truncate mb-0">Bu oyda ro'yhatga olinganlar</p>
                    </div>
                </div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-shrink-0  me-3 align-self-center">
                        <div class="avatar-sm">
                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                <i class="ri-checkbox-circle-line"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 me-3 align-self-center">
                        <div id="radialchart-2" class="apex-charts" dir="ltr"></div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mb-3">
                            <?= General::PrettyNumber($monthly_price) ?> so'm
                        </h5>
                        <p class="text-truncate mb-0">Tasdiqlangan to`lovlar (<?= Yii::$app->params['date'][date('m')]
    ?>)</p>
                    </div>
                </div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex text-muted">
                    <div class="flex-shrink-0  me-3 align-self-center">
                        <div class="avatar-sm">
                            <div class="avatar-title bg-light rounded-circle text-warning font-size-20">
                                <i class="ri-alert-line"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 me-3 align-self-center">
                        <div id="radialchart-3" class="apex-charts" dir="ltr"></div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mb-3">
                            <?= General::PrettyNumber($monthly_price_5) ?> so'm
                        </h5>
                        <p class="text-truncate mb-0"> Tasdiqlanganmagan to'lovlar</p>
                    </div>
                </div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex text-muted">
                    <div class="flex-shrink-0  me-3 align-self-center">
                        <div class="avatar-sm">
                            <div class="avatar-title bg-light rounded-circle text-danger font-size-20">
                                <i class="ri-exchange-dollar-line"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="mb-3">
                            <?= General::PrettyNumber($monthly_price_5) ?> so'm
                        </h5>
                        <p class="text-truncate mb-0"> Kutilayotgan to'lovlar (<?= Yii::$app->params['date'][date('m')]
    ?>)</p>
                    </div>
                </div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>



<div class="d-flex justify-content-between">


    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">To'lovlar grafigi</h5>
                    </div>
                </div>

                <div>
                    <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
            <!-- end card-body -->


        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-lg-4 col-md-8 m-10">
        <div class="card" style="margin-left: 15px;">

            <div class="card-body">
                <h4 class="card-title">Statistika <?= date('Y')?></h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Nomi</th>
                                <th>O'qiyotganlar</th>
                                <th>Bitiruvchilar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($type as $item):?>
                            <tr>
                                <td><?= $item->name ?></td>
                                <td><?= $item->cnt ?></td>
                                <td><?= $item->cnt_finish?></td>
                            </tr>
                            <?php endforeach;?>

                            <tr>
                                <td>Loyihalar</td>
                                <td><?= $project?></td>
                                <td><?= $project_finish?></td>
                            </tr>
                            <tr>
                                <td>Ijtimoiy status</td>
                                <td><?= $social?></td>
                                <td><?= $social_finish?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>


<div class="row">
    <div class="card" style="margin-left: 15px;">
        <div class="card-body">
            <h4 class="card-title">Statistika  oylar kesimida.</h4>
            </p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Nomi</th>
                            <th>Yanvar</th>
                            <th>Fevral</th>
                            <th>Mart</th>
                            <th>Aprel</th>
                            <th>Iyun</th>
                            <th>Iyul</th>
                            <th>Ovgust</th>
                            <th>Sentabr</th>
                            <th>Oktabr</th>
                            <th>Noyabar</th>
                            <th>Dekabr</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kompyuter savodhonligi</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                            <td>8</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td>Larry</td>
                            <td>8</td>
                            <td>16</td>
                            <td>Larry</td>
                            <td>8</td>
                            <td>16</td>
                            <td>Larry</td>
                            <td>8</td>
                            <td>16</td>
                            <td>Larry</td>
                            <td>8</td>
                            <td>16</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
    $date = Yii::$app->params['date'];
    $dates = '[';
    foreach ($date as $key => $item) {
        $dates .= '"' . $item . '",';
    }


    $dates = substr($dates, 0, strlen($dates) - 1);
    $dates .= ']';


    $this->registerJsFile("/design/assets/libs/apexcharts/apexcharts.min.js");

    $this->registerJs("
        var options = {
    series: [{
        name: \"Tasdiqlangan\",
        type: \"column\",
        data: [$tasdiqlangan]
    }, 
    {
    name: \"Kutilgan\", 
    type: \"area\", 
    data: [$kutilyotgan]}],
    chart: {height: 350, type: \"line\", stacked: !1, toolbar: {show: !1}},
    stroke: {width: [0, 1, 1], dashArray: [0, 0, 5], curve: \"smooth\"},
    plotOptions: {bar: {columnWidth: \"18%\"}},
    legend: {show: !1},
    fill: {
        opacity: [.85, .25, 1],
        gradient: {
            inverseColors: !1,
            shade: \"light\",
            type: \"vertical\",
            opacityFrom: .85,
            opacityTo: .55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: $dates,
    markers: {size: 0},
    colors: [\"#0bb197\", \"#eff2f7\", \"#ff3d60\"]
},
    chart = new ApexCharts(document.querySelector(\"#mixed-chart\"), options);
    chart.render();
    ")

        ?>