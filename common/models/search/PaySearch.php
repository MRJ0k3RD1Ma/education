<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pay;

/**
 * PaySearch represents the model behind the search form of `common\models\Pay`.
 */
class PaySearch extends Pay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'payment_id', 'price', 'branch_id', 'user_id', 'status_id', 'consept_id'], 'integer'],
            [['code', 'pay_date', 'created', 'updated', 'check_file', 'ads'], 'safe'],
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
        $query = Pay::find()->where(['branch_id'=>\Yii::$app->user->identity->branch_id]);

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
            'id' => $this->id,
            'student_id' => $this->student_id,
            'payment_id' => $this->payment_id,
            'price' => $this->price,
            'pay_date' => $this->pay_date,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'consept_id' => $this->consept_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
