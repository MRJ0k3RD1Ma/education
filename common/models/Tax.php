<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tax".
 *
 * @property int $id
 * @property int|null $type_id
 * @property string|null $price
 * @property string|null $tax
 * @property string|null $tax_bank
 * @property string|null $file
 * @property string|null $ads
 * @property int|null $creator_id
 * @property int|null $confirm_id
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 *
 * @property User $confirm
 * @property User $creator
 * @property TaxType $type
 */
class Tax extends \yii\db\ActiveRecord
{
    public $is_usual;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tax';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id','price','tax','tax_bank'],'required'],
            [['type_id', 'creator_id', 'confirm_id','is_usual','status'], 'integer'],
            [['ads'], 'string'],
            [['created', 'updated','date'], 'safe'],
            [['price', 'tax', 'tax_bank', 'file'], 'string', 'max' => 255],
            [['confirm_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['confirm_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
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
            'is_usual' => 'Doimiy harajatga qo`shish',
            'type_id' => 'Harajat nomi',
            'price' => 'Narxi',
            'tax' => 'Soliq',
            'status' => 'Status',
            'tax_bank' => 'Bank solig`i',
            'file' => 'Fayl',
            'ads' => 'Izoh',
            'creator_id' => 'Kirituvchi',
            'confirm_id' => 'Tasdiqlovchi',
            'created' => 'Yaratildi',
            'updated' => 'O`zgardi',
        ];
    }

    /**
     * Gets query for [[Confirm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirm()
    {
        return $this->hasOne(User::class, ['id' => 'confirm_id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
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
