<?php

use common\models\Branch;
use common\models\User;
use common\models\UserRole;
use common\models\UserType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Foydalanuvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="card">
        <div class="card-body">

            <p>
                <?= Html::a('Foydalanuvchi qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'name',
                    'username',
//                    'password',
//                    'branch_id',
                    [
                        'attribute'=>'branch_id',
                        'value'=>function($d){
                            return @$d->branch->name;
                        },
                        'filter'=> ArrayHelper::map(Branch::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'role_id',
                        'value'=>function($d){
                            return $d->role->name;
                        },
                        'filter'=> ArrayHelper::map(UserRole::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'type_id',
                        'value'=>function($d){
                            return $d->type->name;
                        },
                        'filter'=> ArrayHelper::map(UserType::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'status',
                        'value'=>function($d){
                            return @Yii::$app->params['status'][$d->status];
                        },
                        'filter'=> Yii::$app->params['status']
                    ],
                    [
                        'attribute'=>'state',
                        'value'=>function($d){
                            return @Yii::$app->params['state'][$d->state];
                        },
                        'filter'=> Yii::$app->params['state']
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, User $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
