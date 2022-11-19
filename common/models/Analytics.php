<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "analytics".
 *
 * @property int $person_id
 * @property int $type_id
 * @property string|null $created
 *
 * @property Person $person
 * @property AnalyticsType $type
 */
class Analytics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analytics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'type_id'], 'required'],
            [['person_id', 'type_id'], 'integer'],
            [['created'], 'safe'],
            [['person_id', 'type_id'], 'unique', 'targetAttribute' => ['person_id', 'type_id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnalyticsType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'type_id' => 'Type ID',
            'created' => 'Created',
        ];
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AnalyticsType::class, ['id' => 'type_id']);
    }
}
