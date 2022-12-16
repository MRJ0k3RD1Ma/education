
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <?= edofre\fullcalendar\Fullcalendar::widget([

                    'events'=>  $event,
                ]);
                ?>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">

            <div class="col-md-12">
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
                                    <?= \frontend\components\General::PrettyNumber(10) ?> <span class="text text-muted">nafar</span>
                                </h5>
                                <p class="text-truncate mb-0">Bu oydagi kutilayotgan tushim</p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <div class="col-md-12">
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
                                    <?= \frontend\components\General::PrettyNumber(1000) ?> <span class="text text-muted">nafar</span>
                                </h5>
                                <p class="text-truncate mb-0">O'qituvchiga chiqadigan oylik</p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>

            </div>
            <div class="col-md-12">
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
                                    <?= \frontend\components\General::PrettyNumber(1000) ?> <span class="text text-muted">nafar</span>
                                </h5>
                                <p class="text-truncate mb-0">O'quvchilar to'lagan pul</p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
        </div>
    </div>

</div>
