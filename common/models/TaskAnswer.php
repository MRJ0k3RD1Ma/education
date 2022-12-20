<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_answer".
 *
 * @property int $task_id
 * @property int $user_id
 * @property string|null $detail
 * @property int $id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status_id
 * @property string|null $comment
 * @property int|null $confirm_id
 *
 * @property User $confirm
 * @property TaskAnswerStatus $status
 * @property Task $task
 * @property User $user
 */
class TaskAnswer extends \yii\db\ActiveRecord
{
    public $files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'id'], 'required'],
            [['task_id', 'user_id', 'id', 'status_id', 'confirm_id'], 'integer'],
            [['detail', 'comment','files'], 'string'],
            [['created', 'updated'], 'safe'],
            [['task_id', 'user_id', 'id'], 'unique', 'targetAttribute' => ['task_id', 'user_id', 'id']],
            [['confirm_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['confirm_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskAnswerStatus::class, 'targetAttribute' => ['status_id' => 'id']],
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
            'task_id' => 'Topshiriq',
            'user_id' => 'Foydalanuvchi',
            'detail' => 'Batafsil',
            'id' => 'ID',
            'files' => 'Fayl',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'status_id' => 'Status',
            'comment' => 'Izoh',
            'confirm_id' => 'Tasdiqladi',
        ];
    }

    /**
     * Gets query for [[Confirm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirm()
    {
        return $this->hasOne(User::class, ['id' => 'confirm_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskAnswerStatus::class, ['id' => 'status_id']);
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
