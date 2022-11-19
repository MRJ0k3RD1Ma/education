<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cource".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property int $price
 * @property int $duration
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Groups[] $groups
 */
class Cource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'price', 'duration'], 'integer'],
            [['price'], 'required'],
            [['created', 'updated'], 'safe'],
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
            'price' => 'Price',
            'duration' => 'Duration',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::class, ['course_id' => 'id']);
    }
}
