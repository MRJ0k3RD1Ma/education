<h4><?= $date?>-sanadagi davomat</h4>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>FIO</th>
            </tr>
        </thead>
        <tbody>
            <?php $n=0; foreach ($model as $item): $st = $item->student; $n++?>
                <tr>
                    <td><?= $n ?></td>
                    <td><?= $item->status == 0 ? 'Yo`q':'Bor' ?></td>
                    <td><?= $st->person->name ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>



