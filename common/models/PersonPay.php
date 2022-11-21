<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person_pay".
 *
 * @property int $person_id
 * @property int $group_id
 * @property int $id
 * @property string|null $pay_date
 * @property int|null $status_id
 * @property int|null $price
 * @property string|null $code
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Groups $group
 * @property Person $person
 * @property PersonPayStatus $status
 */
class PersonPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'group_id', 'id'], 'required'],
            [['person_id', 'group_id', 'id', 'status_id', 'price'], 'integer'],
            [['pay_date', 'created', 'updated'], 'safe'],
            [['code'], 'string', 'max' => 255],
            [['person_id', 'group_id', 'id'], 'unique', 'targetAttribute' => ['person_id', 'group_id', 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonPayStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'FIO',
            'group_id' => 'Guruh nomi',
            'id' => 'Oylik to`lov',
            'pay_date' => 'To`lovning oxirgi sanasi',
            'status_id' => 'Status',
            'price' => 'To`lov summasi',
            'code' => 'Kod',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
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
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(PersonPayStatus::class, ['id' => 'status_id']);
    }
}
