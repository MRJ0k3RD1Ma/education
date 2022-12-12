<?php

namespace frontend\modules\teacher\controllers;

use common\models\Groups;
use common\models\search\GroupsSearch;
use common\models\Student;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
/**
 * Default controller for the `teacher` module
 */
class GroupController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->searchTeacher($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        if($model = Groups::find()->select(['groups.*'])
            ->innerJoin('group_teacher','groups.id = group_teacher.group_id')
            ->andWhere(['group_teacher.teacher_id'=>Yii::$app->user->id])
            ->andWhere(['groups.id'=>$id])
            ->one()){
            return $this->render('view', [
                'model' => $model,
            ]);
        }else{
            throw new NotFoundHttpException();
        }
    }

    public function actionAttendance($id){
        if($model = Groups::find()->select(['groups.*'])
            ->innerJoin('group_teacher','groups.id = group_teacher.group_id')
            ->andWhere(['group_teacher.teacher_id'=>Yii::$app->user->id])
            ->andWhere(['groups.id'=>$id])
            ->one()){
            $student = Student::find()->where(['group_id'=>$id])->all();
            return $this->render('attendance', [
                'model' => $model,
                'student'=>$student
            ]);
        }else{
            throw new NotFoundHttpException();
        }
    }

}
