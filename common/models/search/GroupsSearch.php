<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Groups;

/**
 * GroupsSearch represents the model behind the search form of `common\models\Groups`.
 */
class GroupsSearch extends Groups
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'course_id', 'status_id', 'day_id', 'type_id', 'price', 'creator_id', 'room_id'], 'integer'],
            [['name', 'start_date', 'time', 'created', 'updated'], 'safe'],
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
        $query = Groups::find()->where(['branch_id'=>\Yii::$app->user->identity->branch_id])
            ->orderBy(['status_id'=>SORT_ASC,'id'=>SORT_DESC]);

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
            'branch_id' => $this->branch_id,
            'course_id' => $this->course_id,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date,
            'day_id' => $this->day_id,
            'type_id' => $this->type_id,
            'price' => $this->price,
            'created' => $this->created,
            'updated' => $this->updated,
            'creator_id' => $this->creator_id,
            'room_id' => $this->room_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'time', $this->time]);

        return $dataProvider;
    }

    public function searchBman($params)
    {
        $query = Groups::find()
            ->orderBy(['status_id'=>SORT_ASC,'id'=>SORT_DESC]);

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
            'branch_id' => $this->branch_id,
            'course_id' => $this->course_id,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date,
            'day_id' => $this->day_id,
            'type_id' => $this->type_id,
            'price' => $this->price,
            'created' => $this->created,
            'updated' => $this->updated,
            'creator_id' => $this->creator_id,
            'room_id' => $this->room_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'time', $this->time]);

        return $dataProvider;
    }

    public function searchTeacher($params)
    {
        $query = Groups::find()
            ->where(['branch_id'=>\Yii::$app->user->identity->branch_id])
            ->select(['groups.*'])
            ->innerJoin('group_teacher','groups.id = group_teacher.group_id')
            ->andWhere(['group_teacher.teacher_id'=>\Yii::$app->user->id])
            ->orderBy(['status_id'=>SORT_ASC,'id'=>SORT_DESC]);

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
            'branch_id' => $this->branch_id,
            'course_id' => $this->course_id,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date,
            'day_id' => $this->day_id,
            'type_id' => $this->type_id,
            'price' => $this->price,
            'created' => $this->created,
            'updated' => $this->updated,
            'creator_id' => $this->creator_id,
            'room_id' => $this->room_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'time', $this->time]);

        return $dataProvider;
    }
}
