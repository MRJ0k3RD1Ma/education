<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tax_usual".
 *
 * @property int $id
 * @property int|null $type_id
 * @property string|null $price
 * @property string|null $tax
 * @property string|null $tax_bank
 * @property string|null $ads
 * @property int|null $creator_id
 * @property string|null $created
 * @property string|null $updated
 *
 * @property TaxType $type
 */
class TaxUsual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tax_usual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'creator_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['price', 'tax', 'tax_bank', 'ads'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'price' => 'Price',
            'tax' => 'Tax',
            'tax_bank' => 'Tax Bank',
            'ads' => 'Ads',
            'creator_id' => 'Creator ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TaxType::class, ['id' => 'type_id']);
    }
}
