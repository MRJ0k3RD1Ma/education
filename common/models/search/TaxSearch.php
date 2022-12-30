<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tax;

/**
 * TaxSearch represents the model behind the search form of `common\models\Tax`.
 */
class TaxSearch extends Tax
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'creator_id', 'confirm_id'], 'integer'],
            [['price', 'tax', 'tax_bank', 'file', 'ads', 'created', 'updated'], 'safe'],
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
        $query = Tax::find();

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
            'type_id' => $this->type_id,
            'creator_id' => $this->creator_id,
            'confirm_id' => $this->confirm_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'tax_bank', $this->tax_bank])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
