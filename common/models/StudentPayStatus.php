<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_pay_status".
 *
 * @property int $id
 * @property string|null $name
 * @property string $class
 *
 * @property StudentPay[] $studentPays
 */
class StudentPayStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_pay_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['class'], 'string', 'max' => 255],
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
            'class' => 'Class',
        ];
    }

    /**
     * Gets query for [[StudentPays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPays()
    {
        return $this->hasMany(StudentPay::class, ['status_id' => 'id']);
    }
}
