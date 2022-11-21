<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PersonPay;

/**
 * PersonPaySearch represents the model behind the search form of `common\models\PersonPay`.
 */
class PersonPaySearch extends PersonPay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'group_id', 'id', 'status_id', 'price'], 'integer'],
            [['pay_date', 'code', 'created', 'updated',], 'safe'],
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
        $query = PersonPay::find()->where('group_id in (select id from groups where branch_id='.\Yii::$app->user->identity->branch_id.')')
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

        // grid filtering conditions
        $query->andFilterWhere([
            'person_id' => $this->person_id,
            'group_id' => $this->group_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'status_id' => $this->status_id,
            'price' => $this->price,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
