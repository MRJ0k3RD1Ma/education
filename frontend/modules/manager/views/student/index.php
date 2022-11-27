<?php

use common\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\StudentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hozrda o`qiyotganlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <div class="card">
        <div class="card-body">
            <p style="text-align: right">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="fa fa-search"></span> Qidiruv</button>
            </p>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    [
                        'attribute'=>'code',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/manager/student/view','id'=>$d->id]);
                            return "<a href='{$url}'>{$d->code}</a>";
                        },
                        'format'=>'raw',
                    ],
                    [
                        'attribute'=>'group_id',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/manager/groups/view','id'=>$d->group_id]);
                            return "<a href='{$url}'>{$d->group->name}</a>";
                        },
                        'format'=>'raw',
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Groups::find()->where(['branch_id'=>Yii::$app->user->identity->branch_id])->all(),'id','name'),
                    ],
                    [
                        'attribute'=>'person_id',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/manager/person/view','id'=>$d->person_id]);
                            return "<a href='{$url}'>{$d->person->name}</a>";
                        },
                        'filter'=>false,
                        'format'=>'raw',
                    ],
//                    'code',
//                    'code_id',
//                    'group_id',
//                    'person_id',
                    //'social_id',
                    [
                        'attribute'=>'social_id',
                        'value'=>function($d){return $d->social->name;},
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\PersonSocial::find()->all(),'id','name')
                    ],
                    [
                        'attribute'=>'project_id',
                        'value'=>function($d){return $d->project->name;},
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Project::find()->all(),'id','name')
                    ],
                    //'project_id',
                    //'created',
                    //'updated',
                    //'creator_id',
                    //'branch_id',
                    //'status',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Student $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
