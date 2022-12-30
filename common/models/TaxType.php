<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tax_type".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property TaxUsual[] $taxUsuals
 * @property Tax[] $taxes
 */
class TaxType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tax_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[TaxUsuals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxUsuals()
    {
        return $this->hasMany(TaxUsual::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[Taxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxes()
    {
        return $this->hasMany(Tax::class, ['type_id' => 'id']);
    }
}
