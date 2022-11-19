<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_teacher".
 *
 * @property int $teacher_id
 * @property int $group_id
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Groups $group
 * @property User $teacher
 */
class GroupTeacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'group_id'], 'required'],
            [['teacher_id', 'group_id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['teacher_id', 'group_id'], 'unique', 'targetAttribute' => ['teacher_id', 'group_id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'group_id' => 'Group ID',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
}
