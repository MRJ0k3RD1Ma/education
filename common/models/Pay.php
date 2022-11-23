<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pay".
 *
 * @property int $id
 * @property int $student_id
 * @property int $payment_id
 * @property int $price
 * @property string $pay_date
 * @property int $branch_id
 * @property int $user_id
 * @property string|null $created
 * @property string|null $updated
 * @property int $status_id
 * @property int|null $consept_id
 * @property string|null $check_file
 * @property string|null $ads
 *
 * @property Branch $branch
 * @property User $consept
 * @property Payment $payment
 * @property PayStatus $status
 * @property Student $student
 * @property User $user
 */
class Pay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'payment_id', 'price', 'pay_date', 'branch_id', 'user_id'], 'required'],
            [['student_id', 'payment_id', 'price', 'branch_id', 'user_id', 'status_id', 'consept_id'], 'integer'],
            [['pay_date', 'created', 'updated'], 'safe'],
            [['ads','code'], 'string'],
            [['check_file'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['consept_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['consept_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'O`quvchi',
            'payment_id' => 'To`lov turi',
            'code' => 'Kod',
            'price' => 'Summa',
            'pay_date' => 'Sana',
            'branch_id' => 'Filial',
            'user_id' => 'Yaratdi',
            'created' => 'Yaratilgan',
            'updated' => 'Tasdiqlangan',
            'status_id' => 'Status',
            'consept_id' => 'Tasdiqladi',
            'check_file' => 'Chek',
            'ads' => 'Izoh',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[Consept]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsept()
    {
        return $this->hasOne(User::class, ['id' => 'consept_id']);
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(PayStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
