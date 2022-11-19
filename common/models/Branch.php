<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $target
 * @property string|null $location
 * @property string|null $phone
 * @property int|null $code
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status
 *
 * @property Groups[] $groups
 * @property Pay[] $pays
 * @property User[] $users
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location'], 'string'],
            [['code', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['address', 'target'], 'string', 'max' => 500],
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
            'address' => 'Manzil',
            'target' => 'Mo`ljal',
            'location' => 'Lokatsiya',
            'phone' => 'Telefon',
            'code' => 'Kod',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::class, ['branch_id' => 'id']);
    }

    /**
     * Gets query for [[Pays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays()
    {
        return $this->hasMany(Pay::class, ['branch_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['branch_id' => 'id']);
    }
}
