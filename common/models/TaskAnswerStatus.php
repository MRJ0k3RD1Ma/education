<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_answer_status".
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 *
 * @property TaskAnswer[] $taskAnswers
 */
class TaskAnswerStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_answer_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[TaskAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAnswers()
    {
        return $this->hasMany(TaskAnswer::class, ['status_id' => 'id']);
    }
}
