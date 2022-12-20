<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_answer_file".
 *
 * @property int $task_id
 * @property int $user_id
 * @property int $id
 * @property int $ans_id
 * @property string|null $created
 * @property string|null $updated
 * @property string $file
 *
 * @property Task $task
 * @property User $user
 */
class TaskAnswerFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_answer_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id','ans_id', 'id'], 'required'],
            [['task_id', 'user_id','ans_id', 'id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['task_id', 'user_id', 'id'], 'unique', 'targetAttribute' => ['task_id', 'user_id', 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'id' => 'ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'file' => 'File',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
