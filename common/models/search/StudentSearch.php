<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    public $per;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code_id', 'group_id', 'person_id', 'social_id', 'project_id', 'creator_id', 'branch_id', 'status'], 'integer'],
            [['code', 'created','per', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Student::find()->select('student.*')
            ->innerJoin('person','person.id = student.person_id')
            ->where(['student.branch_id'=>\Yii::$app->user->identity->branch_id])
            ->andWhere(['<>','student.status',1])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'student.id' => $this->id,
            'student.code_id' => $this->code_id,
            'student.group_id' => $this->group_id,
            'student.person_id' => $this->person_id,
            'student.social_id' => $this->social_id,
            'student.project_id' => $this->project_id,
            'student.created' => $this->created,
            'student.updated' => $this->updated,
            'student.creator_id' => $this->creator_id,
            'student.branch_id' => $this->branch_id,
            'student.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'student.code', $this->code])
        ->andFilterWhere(['like','person.name',$this->per]);

        return $dataProvider;
    }
    public function searchBman($params)
    {
        $query = Student::find()->select('student.*')
            ->innerJoin('person','person.id = student.person_id')
            ->andWhere(['<>','student.status',1])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'student.id' => $this->id,
            'student.code_id' => $this->code_id,
            'student.group_id' => $this->group_id,
            'student.person_id' => $this->person_id,
            'student.social_id' => $this->social_id,
            'student.project_id' => $this->project_id,
            'student.created' => $this->created,
            'student.updated' => $this->updated,
            'student.creator_id' => $this->creator_id,
            'student.branch_id' => $this->branch_id,
            'student.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'student.code', $this->code])
            ->andFilterWhere(['like','person.name',$this->per]);

        return $dataProvider;
    }

    public function searchDone($params)
{
    $query = Student::find()->select('student.*')
        ->innerJoin('person','person.id = student.person_id')
        ->where(['student.branch_id'=>\Yii::$app->user->identity->branch_id])
        ->andWhere(['=','student.status',3])
        ->andWhere('0 = (select count(student_pay.id) from student_pay where student.id=student_pay.student_id and student_pay.status_id <> 3)')
    ;

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
        // uncomment the following line if you do not want to return any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
    }
    // grid filtering conditions
    $query->andFilterWhere([
        'student.id' => $this->id,
        'student.code_id' => $this->code_id,
        'student.group_id' => $this->group_id,
        'student.person_id' => $this->person_id,
        'student.social_id' => $this->social_id,
        'student.project_id' => $this->project_id,
        'student.created' => $this->created,
        'student.updated' => $this->updated,
        'student.creator_id' => $this->creator_id,
        'student.branch_id' => $this->branch_id,
        'student.status' => $this->status,
    ]);

    $query->andFilterWhere(['like', 'student.code', $this->code])
        ->andFilterWhere(['like','person.name',$this->per]);

    return $dataProvider;
}

    public function searchDoneBman($params)
    {
        $query = Student::find()->select('student.*')
            ->innerJoin('person','person.id = student.person_id')
            ->andWhere(['=','student.status',3])
            ->andWhere('0 = (select count(student_pay.id) from student_pay where student.id=student_pay.student_id and student_pay.status_id <> 3)')
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'student.id' => $this->id,
            'student.code_id' => $this->code_id,
            'student.group_id' => $this->group_id,
            'student.person_id' => $this->person_id,
            'student.social_id' => $this->social_id,
            'student.project_id' => $this->project_id,
            'student.created' => $this->created,
            'student.updated' => $this->updated,
            'student.creator_id' => $this->creator_id,
            'student.branch_id' => $this->branch_id,
            'student.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'student.code', $this->code])
            ->andFilterWhere(['like','person.name',$this->per]);

        return $dataProvider;
    }
}
