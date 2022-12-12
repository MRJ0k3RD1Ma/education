<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_class".
 *
 * @property int $teacher_id
 * @property int $group_id
 * @property string $date_class
 * @property int $status
 */
class GroupClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'group_id', 'date_class', 'status'], 'required'],
            [['teacher_id', 'group_id', 'status'], 'integer'],
            [['date_class'], 'safe'],
            [['teacher_id', 'group_id', 'date_class'], 'unique', 'targetAttribute' => ['teacher_id', 'group_id', 'date_class']],
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
            'date_class' => 'Date Class',
            'status' => 'Status',
        ];
    }

    public function getTeacher(){
        return $this->hasOne(User::className(),['id'=>'teacher_id']);
    }
}
