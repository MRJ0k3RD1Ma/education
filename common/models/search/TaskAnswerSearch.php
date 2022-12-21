<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaskAnswer;
use Yii;
/**
 * TaskAnswerSearch represents the model behind the search form of `common\models\TaskAnswer`.
 */
class TaskAnswerSearch extends TaskAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'id', 'status_id', 'confirm_id'], 'integer'],
            [['detail', 'created', 'updated', 'comment'], 'safe'],
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
        $query = TaskAnswer::find();

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
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'id' => $this->id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'confirm_id' => $this->confirm_id,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

     public function searchCreator($params)
    {
        $query = TaskAnswer::find()->select(['task_answer.*'])->innerJoin('task','task.id task_answer.id')->where('(task.user_id = '.Yii::$app->user->id.' or task.creator_id='.Yii::$app->user->id.')')
            ->andWhere(['task_answer.status_id'=>1])->orderBy(['task_answer.updated'=>SORT_DESC]);

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
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'id' => $this->id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'confirm_id' => $this->confirm_id,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }




}
