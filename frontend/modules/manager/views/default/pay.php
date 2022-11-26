<?php

use common\models\StudentPay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\search\StudentPaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'To`lovlar ro`yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-pay-index">

    <div class="card">
        <div class="card-body">

            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_pay_list'
            ]) ?>



        </div>
    </div>

<div class="container">
    
</div>
</div>
