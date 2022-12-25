<?php

namespace frontend\modules\manager\controllers;

use common\models\GroupType;
use common\models\Person;
use common\models\PersonSocial;
use common\models\Project;
use common\models\search\StudentPaySearch;
use common\models\Student;
use common\models\StudentPay;
use common\models\StudentType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;
/**
 * Default controller for the `manager` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($type = 0)
    {
        if($type == 0){
            $order = "student.id";
        }else{
            $order = 'student.person_id';
        }

        $branch_id = Yii::$app->user->identity->branch_id;
        $monthly_person = Person::find()->where(['branch_id'=>$branch_id])->andFilterWhere(['like','created',date('Y-m')])->count('id');

        $monthly_price = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>3])->andFilterWhere(['like','created',date('Y-m')])->sum('price');

        $monthly_price_5 = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>2])->sum('price');

        $tasdiqlangan = '';
        for($i=1; $i<=12; $i++){
            if($i<10){
                $t = '0'.$i;
            }else{
                $t = $i;
            }
            if($q = StudentPay::find()->where(['branch_id'=>$branch_id,'status_id'=>3])->andFilterWhere(['like','updated',date('Y-').$t])->sum('price')){
                $tasdiqlangan .= $q.',';
            }else{
                $tasdiqlangan .= '0,';

            }
        }
        $tasdiqlangan = substr($tasdiqlangan,0,strlen($tasdiqlangan)-1);

        $kutilyotgan = '';
        for($i=1; $i<=12; $i++){
            if($i<10){
                $t = '0'.$i;
            }else{
                $t = $i;
            }
            if($q = StudentPay::find()->where(['branch_id'=>$branch_id])->andFilterWhere(['like','pay_date',date('Y-').$t])->sum('price')){
                $kutilyotgan .= $q.',';
            }else{
                $kutilyotgan .= '0,';

            }
        }
        $kutilyotgan = substr($kutilyotgan,0,strlen($kutilyotgan)-1);


        $project = Student::find()->where(['<>','project_id',1])->andWhere(['branch_id'=>$branch_id])->andWhere(['status'=>1])->andFilterWhere(['like','created',date('Y')])->count('id');
        $project_finish = Student::find()->where(['<>','project_id',1])->andWhere(['branch_id'=>$branch_id])->andWhere('status = 3 or status=4')->andFilterWhere(['like','created',date('Y')])->count('id');

        $social = Student::find()->where(['<>','social_id',1])->andWhere(['branch_id'=>$branch_id])->andWhere(['status'=>1])->andFilterWhere(['like','created',date('Y')])->count('id');
        $social_finish = Student::find()->where(['<>','social_id',1])->andWhere(['branch_id'=>$branch_id])->andWhere('status = 3 or status=4')->andFilterWhere(['like','created',date('Y')])->count('id');

        $students = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $students[$i] = Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$branch_id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std = Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$branch_id])->groupBy($order)->count('*');
        $student_type = [];
        $student_types = StudentType::find()->all();
        foreach ($student_types as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $student_type[$item->id][$i] = Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$branch_id])->andWhere(['type_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_type = Student::find()->where(['=','status','1'])->andWhere(['type_id'=>$item->id])->andWhere(['branch_id'=>$branch_id])->groupBy($order)->count('*');
        $projects = Project::find()->all();
        $project_cnt = [];
        foreach ($projects as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $project_cnt[$item->id][$i] = Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$branch_id])->andWhere(['project_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_project = Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$branch_id])->andWhere(['project_id'=>$item->id])->groupBy($order)->count('*');
        $socials = PersonSocial::find()->all();
        $social_cnt = [];
        foreach ($socials as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $social_cnt[$item->id][$i] = Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$branch_id])->andWhere(['social_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_social = Student::find()->where(['=','status','1'])->andWhere(['social_id'=>$item->id])->andWhere(['branch_id'=>$branch_id])->groupBy($order)->count('*');
        $old_to_12 = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_to_12[$i] = Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$branch_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_to_12 = Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$branch_id])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
            ->groupBy($order)->count('*');
        $old_12_30 = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_12_30[$i] = Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$branch_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_12_30 = Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$branch_id])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
            ->groupBy($order)->count('*');
        $old_30_to = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_30_to[$i] = Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$branch_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_30_to = Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$branch_id])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
            ->groupBy($order)->count('*');
        $credit = StudentPay::find()->where(['<>','status_id',3])->andWhere(['branch_id'=>$branch_id])->andWhere(['<','pay_date',date('Y-m-d')])->sum('price');

        return $this->render('index',[
            'monthly_person'=>$monthly_person,
            'monthly_price'=>$monthly_price,
            'monthly_price_5'=>$monthly_price_5,
            'tasdiqlangan'=>$tasdiqlangan,
            'kutilyotgan'=>$kutilyotgan,
            'students'=>$students,
            'project'=>$project,
            'project_finish'=>$project_finish,
            'social'=>$social,
            'social_finish'=>$social_finish,
            'student_types'=>$student_types,
            'student_type'=>$student_type,
            'projects'=>$projects,
            'project_cnt'=>$project_cnt,
            'socials'=>$socials,
            'social_cnt'=>$social_cnt,
            'old_to_12'=>$old_to_12,
            'old_12_30'=>$old_12_30,
            'old_30_to'=>$old_30_to,
            'type'=>$type,
            'std_old_30_to'=>$std_old_30_to,
            'std_old_12_30'=>$std_old_12_30,
            'std_old_to_12'=>$std_old_to_12,
            'std_social'=>$std_social,
            'std_project'=>$std_project,
            'std_type'=>$std_type,
            'std'=>$std,
            'credit'=>$credit
        ]);
    }

    public function actionPay($export = null){

        $searchModel = new StudentPaySearch();
        $dataProvider = $searchModel->searchManager($this->request->queryParams);
        if($export == 1){
            $searchModel->exportToExcel($dataProvider->query);
        }


        return $this->render('pay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPaysend($id,$student_id){
        if($model = StudentPay::findOne(['id'=>$id,'student_id'=>$student_id,'branch_id'=>Yii::$app->user->identity->branch_id])){
            $code = $model->code;
            $price = $model->price;
            $model->scenario = "paying";
            if($model->load($this->request->post())){
                $model->code = $code;
                $model->price = $price;
                $model->user_id = Yii::$app->user->id;
                if($model->check_file = UploadedFile::getInstance($model,'check_file')){
                    $name = microtime(true).'.'.$model->check_file->extension;
                    $model->check_file->saveAs(Yii::$app->basePath.'/web/uploads/check/'.$name);
                    $model->check_file = $name;
                }
                $model->status_id = 2;
                if($model->save()){
                    return $this->redirect(['view','id'=>$model->id,'student_id'=>$model->student_id]);
                }
            }
            return $this->render('_paysend',['model'=>$model,'student'=>$model->student]);

        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionView($student_id, $id)
    {
        $model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id]);
        return $this->render('view', [
            'model' => $model
        ]);
    }



    public function actionStat($year = null){
        $branch_id = Yii::$app->user->identity->branch_id;
        if(!$year){
            $year = date('Y');
        }

        $type = [];

        for($i=1; $i<=12; $i++){
            $type[$i] = GroupType::find()->
            select(['group_type.*',
                '(SELECT COUNT(student.id) FROM student WHERE student.status=1 and student.group_id IN (SELECT id FROM `groups` WHERE group_type.id=`groups`.type_id)) AS cnt',
                '(SELECT COUNT(student.id) FROM student WHERE (student.status=3 or student.status=4) and  student.group_id IN (SELECT id FROM `groups` WHERE group_type.id=`groups`.type_id)) AS cnt_finish'
            ])->all();
        }


        return $this->render('stat',[
            'year'=>$year
        ]);

    }

}
