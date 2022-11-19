<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person_wish".
 *
 * @property int $person_id
 * @property int $course_id
 * @property int|null $day_id
 * @property string|null $created
 * @property int|null $branch_id
 * @property string|null $time
 *
 * @property Branch $branch
 * @property Cource $course
 * @property GroupDay $day
 * @property Person $person
 */
class PersonWish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_wish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'course_id'], 'required'],
            [['person_id', 'course_id', 'day_id', 'branch_id'], 'integer'],
            [['created','time'], 'safe'],
            [['person_id', 'course_id'], 'unique', 'targetAttribute' => ['person_id', 'course_id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cource::class, 'targetAttribute' => ['course_id' => 'id']],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupDay::class, 'targetAttribute' => ['day_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'O`quvchi',
            'course_id' => 'Kurs nomi',
            'day_id' => 'Kurs vaqti',
            'created' => 'Kiritildi',
            'branch_id' => 'Filial',
            'time' => 'Soati',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Cource::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(GroupDay::class, ['id' => 'day_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }
}
