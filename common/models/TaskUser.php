<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_user".
 *
 * @property int $task_id
 * @property int $user_id
 * @property int|null $type_id
 * @property int $exec_id
 * @property string|null $created
 * @property string $updated
 * @property int|null $status_id
 * @property int|null $sms_status
 * @property string|null $deadline
 *
 * @property User $exec
 * @property TaskUserStatus $status
 * @property Task $task
 * @property TaskType $type
 * @property User $user
 */
class TaskUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'exec_id'], 'required'],
            [['task_id', 'user_id', 'type_id', 'exec_id', 'status_id', 'sms_status'], 'integer'],
            [['created', 'updated', 'deadline'], 'safe'],
            [['task_id', 'user_id', 'exec_id'], 'unique', 'targetAttribute' => ['task_id', 'user_id', 'exec_id']],
            [['exec_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['exec_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskUserStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type ID',
            'exec_id' => 'Exec ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'status_id' => 'Status ID',
            'sms_status' => 'Sms Status',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * Gets query for [[Exec]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExec()
    {
        return $this->hasOne(User::class, ['id' => 'exec_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskUserStatus::class, ['id' => 'status_id']);
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TaskType::class, ['id' => 'type_id']);
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
