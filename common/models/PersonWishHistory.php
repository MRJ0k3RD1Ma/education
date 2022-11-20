<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person_wish_history".
 *
 * @property int $id
 * @property int|null $person_id
 * @property int|null $course_id
 * @property int|null $day_id
 * @property string|null $time
 * @property int|null $branch_id
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $ads
 *
 * @property Branch $branch
 * @property Cource $course
 * @property GroupDay $day
 * @property Person $person
 */
class PersonWishHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_wish_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'course_id', 'day_id', 'branch_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['time', 'ads'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'person_id' => 'O`quvchi',
            'course_id' => 'Kurs',
            'day_id' => 'Kurs kuni',
            'time' => 'Kurs vaqti',
            'branch_id' => 'Filial',
            'created' => 'Yozildi',
            'updated' => 'O`chirildi',
            'ads' => 'Izoh',
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
