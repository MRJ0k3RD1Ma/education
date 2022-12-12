<?php

namespace frontend\modules\teacher\controllers;

use Codeception\Platform\Group;
use common\models\Attendance;
use common\models\GroupClass;
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

    public function actionView($id,$start = 0,$stop = 0)
    {
        $tid = Yii::$app->user->id;
        if($model = Groups::find()->select(['groups.*'])
            ->innerJoin('group_teacher','groups.id = group_teacher.group_id')
            ->andWhere(['group_teacher.teacher_id'=>$tid])
            ->andWhere(['groups.id'=>$id])
            ->one()){
            $date = date('Y-m-d');
            if($classes = GroupClass::find()->where(['teacher_id'=>$tid,'group_id'=>$model->id])->andWhere(['<>','date_class',$date])->andWhere(['status'=>1])->all()){
                foreach ($classes as $item){
                    $item->status = 2;
                    $item->save();
                }
            }

            if($class = GroupClass::findOne(['teacher_id'=>$tid,'group_id'=>$model->id,'date_class'=>$date])){

                if($stop == 1){
                    $class->status = 2;
                    $class->save();
                }
                if($class->status == 1){
                    // load multiple o`quvchilar
                    if($req = Yii::$app->request->post()){

                        foreach ($req['Groups']['student_id'] as $key=>$item){
                            $att = Attendance::find()->where(['group_id'=>$model->id])->andWhere(['teacher_id'=>$tid])->andWhere(['date_class'=>$date])->andWhere(['student_id'=>$key])->one();
                            $att->status = $item;
                            $att->save();
                            $att = null;
                        }

                    }
                    return $this->render('view', [
                        'model' => $model,
                        'class'=>$class,
                        'status'=>$class->status
                    ]);
                }else{
                    return $this->render('view', [
                        'model' => $model,
                        'status'=>$class->status
                    ]);
                }
            }elseif($start == 1){
                $student = Student::find()->where(['group_id'=>$model->id])->andWhere(['status'=>1])->all();
                $class = new GroupClass();
                $class->teacher_id = $tid;
                $class->group_id = $model->id;
                $class->date_class = date('Y-m-d');
                $class->status = 1;
                $class->save();
                foreach ($student as $item){
                    $att = new Attendance();
                    $att->group_id = $model->id;
                    $att->student_id = $item->id;
                    $att->teacher_id = $tid;
                    $att->date_class = date('Y-m-d');
                    $att->status = 0;
                    $att->save();
                }
                return $this->render('view', [
                    'model' => $model,
                    'status'=>$class->status
                ]);
            }else{
                return $this->render('view', [
                    'model' => $model,
                    'status'=>0
                ]);
            }

        }else{
            throw new NotFoundHttpException();
        }
    }


}
