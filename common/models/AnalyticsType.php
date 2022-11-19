<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "analytics_type".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 *
 * @property Analytics[] $analytics
 * @property Person[] $people
 */
class AnalyticsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analytics_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Analytics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalytics()
    {
        return $this->hasMany(Analytics::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::class, ['id' => 'person_id'])->viaTable('analytics', ['type_id' => 'id']);
    }
}
