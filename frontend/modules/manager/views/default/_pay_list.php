<?php

$color = "main3";
if($model->status_id==1){
    if($model->pay_date < date('Y-m-d')){
        $color = 'main1';
    }else{
        $color = "main3";
    }
}elseif($model->status_id == 2){
    $color = 'main2';
}elseif($model->status_id == 3){
    $color = '';
}elseif($model->status_id == 5){
    $color = "main1";
}

$btn = "";
if($model->status_id == 2){
    $btn = 'btn2';
}elseif($model->status_id == 3){
    $btn = 'btn1';
}elseif($model->status_id == 1){
    $btn = 'btn3';
}
?>

<div class="main_main <?= $color?>">
    <div class="mains">
        <div class="main-left">
            <h1 class="h1_main">
                <?= $model->student->person->name ?>
                <svg class="svg_main"
                    width="1"
                    height="16"
                    viewBox="0 0 1 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <line x1="0.5" x2="0.5" y2="16" stroke="white" />
                </svg>
                <span><?= $model->code ?></span>
            </h1>
            <h1 class="h1_main">
                <span class="span_main">To’lov sanasi: </span>
                <p class="p_main">&nbsp;<?= $model->status_id == 3 ? $model->paid_date : $model->pay_date ?></p>
                <span class="span">To’lov summasi:</span>
                <p class="p_main">&nbsp;<?= $model->price?> so’m</p>
            </h1>
        </div>

        <div class="main-right">
            <h1 class="h1_main">Kurs nomi: <?= $model->student->group->name ?></h1>
            <?php if($model->status_id == 3 or $model->status_id == 2){?><a href="/uploads/check/<?= $model->check_file?>" class="btn_main">Chekni ko’rish</a><?php }else{
                $url = Yii::$app->urlManager->createUrl(['/manager/default/paysend','student_id'=>$model->student_id,'id'=>$model->id,'type'=>1]);
                ?>
                <a href="<?= $url?>" class="btn_main">To'lovni kiritish</a>
            <?php }?>
        </div>
    </div>
</div>