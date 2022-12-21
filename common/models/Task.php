<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $code_id
 * @property string|null $name
 * @property string|null $detail
 * @property int|null $creator_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status_id
 * @property string|null $deadline
 * @property int|null $state
 * @property int|null $user_id
 * @property int|null $is_user
 *
 * @property User $creator
 * @property TaskStatus $status
 * @property TaskAnswerFile[] $taskAnswerFiles
 * @property TaskAnswer[] $taskAnswers
 * @property TaskFile[] $taskFiles
 * @property TaskUser[] $taskUsers
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    public $time,$files,$task_status;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_id', 'creator_id', 'status_id', 'state', 'user_id', 'is_user'], 'integer'],
            [['detail','files'], 'string'],
            [['created', 'updated', 'deadline'], 'safe'],
            [['code', 'name','time'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Raqami',
            'code_id' => 'Raqam',
            'name' => 'Topshiriq',
            'detail' => 'Batafsil',
            'creator_id' => 'Kirituvchi',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'status_id' => 'Status',
            'deadline' => 'Muddat',
            'files' => 'Fayl',
            'state' => 'State',
            'user_id' => 'Rahbar',
            'is_user' => 'Is User',
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[TaskAnswerFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAnswerFiles()
    {
        return $this->hasMany(TaskAnswerFile::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAnswers()
    {
        return $this->hasMany(TaskAnswer::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFile::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskUsers()
    {
        return $this->hasMany(TaskUser::class, ['task_id' => 'id']);
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
