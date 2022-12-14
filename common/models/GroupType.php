<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Groups[] $groups
 */
class GroupType extends \yii\db\ActiveRecord
{
    public $cnt,$cnt_finish;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'name' => 'Nomi',
            'cnt' => 'Soni',
            'cnt_finish' => 'Soni',
        ];
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::class, ['type_id' => 'id']);
    }
}
