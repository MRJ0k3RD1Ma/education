<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentPay;

/**
 * StudentPaySearch represents the model behind the search form of `common\models\StudentPay`.
 */
class StudentPaySearch extends StudentPay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'id', 'price', 'payment_id', 'branch_id', 'user_id', 'consept_id', 'status_id'], 'integer'],
            [['code', 'pay_date', 'paid_date', 'check_file', 'ads', 'created', 'updated'], 'safe'],
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
        $query = StudentPay::find();

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
            'student_id' => $this->student_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'price' => $this->price,
            'paid_date' => $this->paid_date,
            'payment_id' => $this->payment_id,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'consept_id' => $this->consept_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    public function searchBux($params)
    {
        $query = StudentPay::find()->where('status_id in (2,3,5)');

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
            'student_id' => $this->student_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'price' => $this->price,
            'paid_date' => $this->paid_date,
            'payment_id' => $this->payment_id,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'consept_id' => $this->consept_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    public function searchManager($params)
    {
        $query = StudentPay::find()->andWhere(['branch_id'=>\Yii::$app->user->identity->branch_id])
        ->orderBy(['pay_date'=>SORT_ASC]);

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

        if(!$this->status_id){
            $query->andWhere('status_id not in (2,3,4)');
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'student_id' => $this->student_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'price' => $this->price,
            'paid_date' => $this->paid_date,
            'payment_id' => $this->payment_id,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'consept_id' => $this->consept_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
