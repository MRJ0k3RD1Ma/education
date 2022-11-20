<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person_pay_status".
 *
 * @property int $id
 * @property string|null $name
 * @property string $class
 *
 * @property PersonPay[] $personPays
 */
class PersonPayStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_pay_status';
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
     * Gets query for [[PersonPays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonPays()
    {
        return $this->hasMany(PersonPay::class, ['status_id' => 'id']);
    }
}
