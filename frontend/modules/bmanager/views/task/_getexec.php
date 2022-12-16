<div class="row">
    <div class="col-md-4">
        <div class="form-group field-taskuser-exec_id required has-error">
            <label class="control-label" for="taskuser-exec_id">Bajaruvchi</label>
            <select id="taskuser-exec_id" class="form-control" name="TaskUser[][exec_id]" aria-required="true" aria-invalid="true">
                <option value="">Ijrochini tanlang</option>
                <?php foreach (\common\models\User::find()->where(['status'=>1,'state'=>1])->andWhere(['<>','role_id',1])->orderBy(['role_id'=>SORT_ASC])->all() as $item):?>
                    <option value="<?= $item->id?>"><?= $item->name?></option>
                <?php endforeach;?>
            </select>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group field-taskuser-deadline">
            <label class="control-label" for="taskuser-deadline">Muddat</label>
            <input type="date" id="taskuser-deadline" class="form-control" name="TaskUser[][deadline]">

            <div class="help-block"></div>
        </div>                                    </div>
    <div class="col-md-4">
        <div class="form-group field-taskuser-type_id">
            <label class="control-label" for="taskuser-type_id">Turi</label>
            <select id="taskuser-type_id" class="form-control" name="TaskUser[][type_id]">
                <option value="1">Ijro uchun</option>
                <option value="2">Ma'lumot uchun</option>
            </select>

            <div class="help-block"></div>
        </div>                                    </div>
</div>