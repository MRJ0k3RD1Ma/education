<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $name
 * @property string|null $pnfl
 * @property string|null $inn
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $phone_parent
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Student[] $students
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['pnfl', 'inn', 'birthday', 'phone', 'phone_parent'], 'string', 'max' => 255],
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
            'pnfl' => 'Pnfl',
            'inn' => 'Inn',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'phone_parent' => 'Phone Parent',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['person_id' => 'id']);
    }
}
