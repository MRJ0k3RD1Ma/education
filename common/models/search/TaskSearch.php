<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;
use Yii;
/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code_id', 'creator_id', 'status_id', 'state', 'user_id', 'is_user'], 'integer'],
            [['code', 'name', 'detail', 'created', 'updated', 'deadline'], 'safe'],
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
        $query = Task::find()->orderBy(['id'=>SORT_DESC]);

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
            'code_id' => $this->code_id,
            'creator_id' => $this->creator_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'deadline' => $this->deadline,
            'state' => $this->state,
            'user_id' => $this->user_id,
            'is_user' => $this->is_user,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }

    public function searchManager($params)
    {
        $query = Task::find()
            ->select(['task.*'])
            ->innerJoin('task_user','task_user.task_id = task.id')
            ->where(['task_user.exec_id'=>Yii::$app->user->id])
            ->orderBy(['task.id'=>SORT_DESC]);

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
            'code_id' => $this->code_id,
            'creator_id' => $this->creator_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'deadline' => $this->deadline,
            'state' => $this->state,
            'user_id' => $this->user_id,
            'is_user' => $this->is_user,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
