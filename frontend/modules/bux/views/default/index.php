<div class="card">
    <div class="card-body">
        <h4><?= date('M')?> oyidagi tushumlar ro'yhati</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Filial nomi</th>
                        <?php foreach ($model as $item):?>
                            <th><?= $item->name ?></th>
                        <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; foreach ($branch as $item): $n++?>
                        <tr>
                            <th><?= $n ?></th>
                            <th><?= $item->name ?></th>
                            <?php $cnt = 0; foreach ($model as $i): $cnt += $pay[$item->id][$i->id];?>
                                <td><a href="<?= Yii::$app->urlManager->createUrl(['/bux/default/pay','StudentPaySearch[branch_id]'=>$item->id,'StudentPaySearch[payment_id]'=>$i->id])?>"><?= \frontend\components\General::PrettyNumber($pay[$item->id][$i->id]).' so`m' ?></a></td>
                            <?php endforeach;?>
                            <th><a href="<?= Yii::$app->urlManager->createUrl(['/bux/default/pay','StudentPaySearch[branch_id]'=>$item->id])?>"><?= \frontend\components\General::PrettyNumber($cnt)?> so'm</a></th>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="2" style="text-align: right">Jami</th>
                        <?php $cnt = 0; foreach ($model as $i): $cnt += $pay[0][$i->id]?>
                            <th><a href="<?= Yii::$app->urlManager->createUrl(['/bux/default/pay','StudentPaySearch[payment_id]'=>$i->id])?>"><?= \frontend\components\General::PrettyNumber($pay[0][$i->id]).' so`m' ?></a></th>
                        <?php endforeach;?>
                        <th><a href="<?= Yii::$app->urlManager->createUrl(['/bux/default/pay'])?>"><?= \frontend\components\General::PrettyNumber($cnt)?> so'm</a></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>