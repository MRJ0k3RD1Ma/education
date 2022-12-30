<?php

namespace frontend\modules\bmanager\controllers;

use common\models\Person;
use common\models\PersonSocial;
use common\models\Project;
use common\models\search\StudentPaySearch;
use common\models\Student;
use common\models\StudentPay;
use common\models\StudentType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
/**
 * Default controller for the `bmanager` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($type = 0,$b_id = 0)
    {
        if($type == 0){
            $order = "student.id";
        }else{
            $order = 'student.person_id';
        }

        $monthly_person = Person::find()->andFilterWhere(['like','created',date('Y-m')])->count('id');

        $monthly_price = StudentPay::find()->where(['status_id'=>3])->andFilterWhere(['like','created',date('Y-m')])->sum('price');

        $monthly_price_5 = StudentPay::find()->where(['status_id'=>2])->sum('price');
        $credit = StudentPay::find()->where(['<>','status_id',3])->andWhere(['<','pay_date',date('Y-m-d')])->sum('price');

        $tasdiqlangan = '';
        for($i=1; $i<=12; $i++){
            if($i<10){
                $t = '0'.$i;
            }else{
                $t = $i;
            }
            if($q = StudentPay::find()->where(['status_id'=>3])->andFilterWhere(['like','updated',date('Y-').$t])->sum('price')){
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
            if($q = StudentPay::find()->andFilterWhere(['like','pay_date',date('Y-').$t])->sum('price')){
                $kutilyotgan .= $q.',';
            }else{
                $kutilyotgan .= '0,';

            }
        }
        $kutilyotgan = substr($kutilyotgan,0,strlen($kutilyotgan)-1);


        $project = Student::find()->where(['<>','project_id',1])->andWhere(['status'=>1])->andFilterWhere(['like','created',date('Y')])->count('id');
        $project_finish = Student::find()->where(['<>','project_id',1])->andWhere('status = 3 or status=4')->andFilterWhere(['like','created',date('Y')])->count('id');

        $social = Student::find()->where(['<>','social_id',1])->andWhere(['status'=>1])->andFilterWhere(['like','created',date('Y')])->count('id');
        $social_finish = Student::find()->where(['<>','social_id',1])->andWhere('status = 3 or status=4')->andFilterWhere(['like','created',date('Y')])->count('id');



        $students = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $students[$i] = $b_id == 0 ?
                Student::find()->where(['>=','status','3'])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*')
                : Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$b_id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*')
            ;
        }
        $std = $b_id == 0 ?
            Student::find()->where(['=','status','1'])->groupBy($order)->count('*')
        :   Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$b_id])->groupBy($order)->count('*')
        ;
        $student_type = [];
        $student_types = StudentType::find()->all();
        foreach ($student_types as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $student_type[$item->id][$i] = $b_id == 0 ?
                    Student::find()->where(['>=','status','3'])->andWhere(['type_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*')
                    : Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$b_id])->andWhere(['type_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_type = $b_id == 0 ?
            Student::find()->where(['=','status','1'])->andWhere(['type_id'=>$item->id])->groupBy($order)->count('*')
        :   Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$b_id])->andWhere(['type_id'=>$item->id])->groupBy($order)->count('*');
        $projects = Project::find()->all();
        $project_cnt = [];
        foreach ($projects as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $project_cnt[$item->id][$i] = $b_id == 0 ?
                    Student::find()->where(['>=','status','3'])->andWhere(['project_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*')
                :   Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$b_id])->andWhere(['project_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_project = $b_id == 0 ? Student::find()->where(['=','status','1'])->andWhere(['project_id'=>$item->id])->groupBy($order)->count('*')
        :Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$b_id])->andWhere(['project_id'=>$item->id])->groupBy($order)->count('*');
        $socials = PersonSocial::find()->all();
        $social_cnt = [];
        foreach ($socials as $item){
            for($i=1; $i<=12; $i++){
                $t = $i;
                if($t<10){$t = '0'.$i;}
                $social_cnt[$item->id][$i] = $b_id == 0 ?
                    Student::find()->where(['>=','status','3'])->andWhere(['social_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*')
                :   Student::find()->where(['>=','status','3'])->andWhere(['branch_id'=>$b_id])->andWhere(['social_id'=>$item->id])->andFilterWhere(['like','end_date',date('Y-').$t])->groupBy($order)->count('*');
            }
        }
        $std_social = $b_id == 0 ?
            Student::find()->where(['=','status','1'])->andWhere(['social_id'=>$item->id])->groupBy($order)->count('*')
        :Student::find()->where(['=','status','1'])->andWhere(['branch_id'=>$b_id])->andWhere(['social_id'=>$item->id])->groupBy($order)->count('*');
        $old_to_12 = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_to_12[$i] =
                $b_id == 0 ?
                Student::find()->where(['>=','student.status','3'])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*')
            :Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$b_id])
                    ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
                    ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_to_12 = $b_id == 0 ?
            Student::find()->where(['=','student.status','1'])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
            ->groupBy($order)->count('*')
        :Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$b_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<12')
                ->groupBy($order)->count('*');
        $old_12_30 = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_12_30[$i] = $b_id == 0 ?
                Student::find()->where(['>=','student.status','3'])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*')
                :Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$b_id])
                    ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
                    ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_12_30 = $b_id == 0 ?
            Student::find()->where(['=','student.status','1'])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
            ->groupBy($order)->count('*')
        :Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$b_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=12 and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)<30')
                ->groupBy($order)->count('*');
        $old_30_to = [];
        for($i=1; $i<=12; $i++){
            $t = $i;
            if($t<10){$t = '0'.$i;}
            $old_30_to[$i] = $b_id == 0 ?
                Student::find()->where(['>=','student.status','3'])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
                ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*')
            :Student::find()->where(['>=','student.status','3'])->andWhere(['student.branch_id'=>$b_id])
                    ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
                    ->andFilterWhere(['like','student.end_date',date('Y-').$t])->groupBy($order)->count('*');
        }
        $std_old_30_to = $b_id == 0 ?
            Student::find()->where(['=','student.status','1'])
            ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
            ->groupBy($order)->count('*')
        :Student::find()->where(['=','student.status','1'])->andWhere(['student.branch_id'=>$b_id])
                ->innerJoin('person','student.person_id = person.id and TIMESTAMPDIFF(YEAR, person.birthday, student.end_date)>=30')
                ->groupBy($order)->count('*');



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
            'b_id'=>$b_id,
            'credit'=>$credit
        ]);
    }

    public function actionPay(){

        $searchModel = new StudentPaySearch();
        $dataProvider = $searchModel->searchNotaccept($this->request->queryParams);

        return $this->render('pay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllpay($export = null){

        $searchModel = new StudentPaySearch();
        $dataProvider = $searchModel->searchBManager($this->request->queryParams);
        if($export == 1){
            $searchModel->exportToExcel($dataProvider->query);
        }


        return $this->render('pay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($student_id, $id)
    {
        $model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id]);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionAccept($student_id,$id,$type){
        if($model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id,'status_id'=>2])){
            $model->status_id = 3;
            $model->consept_id = \Yii::$app->user->id;
            if($model->save()){
                // personni to'lovlari to'liq o'tgan o'tmaganini aniqlab is_full_paid ni 1 yoki 0 qilish kerak.
                if(0 == StudentPay::find()->where(['student_id'=>$student_id])->andWhere(['<>','status_id',3])->count('*')){
                    $student = Student::findOne($student_id);
                    $student->is_full_paid = 1;
                    $student->save(false);
                }
            }
            return $this->redirect(['view','id'=>$id,'student_id'=>$student_id]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeny($student_id,$id){
        if($model = StudentPay::findOne(['student_id'=>$student_id,'id'=>$id,'status_id'=>2])){
            $model->status_id = 5;
            $model->consept_id = \Yii::$app->user->id;
            if($model->load($this->request->post()) and $model->save()){
                return $this->redirect(['view','id'=>$id,'student_id'=>$student_id]);
            }
            return $this->renderAjax('deny',['model'=>$model]);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
