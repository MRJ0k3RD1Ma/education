<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_pay".
 *
 * @property int $student_id
 * @property int $id
 * @property string $code
 * @property string|null $pay_date
 * @property int|null $price
 * @property string|null $paid_date
 * @property int|null $payment_id
 * @property int|null $branch_id
 * @property int|null $user_id
 * @property int|null $consept_id
 * @property string|null $check_file
 * @property string|null $ads
 * @property int|null $status_id
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Branch $branch
 * @property User $consept
 * @property Payment $payment
 * @property StudentPayStatus $status
 * @property Student $student
 * @property User $user
 */
class StudentPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'id', 'code'], 'required'],
            [['student_id', 'id', 'price', 'payment_id', 'branch_id', 'user_id', 'consept_id', 'status_id'], 'integer'],
            [['pay_date', 'paid_date', 'created', 'updated'], 'safe'],
            [['ads'], 'string'],
            [['code', 'check_file'], 'string', 'max' => 255],
            [['student_id', 'id'], 'unique', 'targetAttribute' => ['student_id', 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['consept_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['consept_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentPayStatus::class, 'targetAttribute' => ['status_id' => 'id']],
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
            'student_id' => 'Student ID',
            'id' => 'ID',
            'code' => 'Code',
            'pay_date' => 'Pay Date',
            'price' => 'Price',
            'paid_date' => 'Paid Date',
            'payment_id' => 'Payment ID',
            'branch_id' => 'Branch ID',
            'user_id' => 'User ID',
            'consept_id' => 'Consept ID',
            'check_file' => 'Check File',
            'ads' => 'Ads',
            'status_id' => 'Status ID',
            'created' => 'Created',
            'updated' => 'Updated',
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
        return $this->hasOne(StudentPayStatus::class, ['id' => 'status_id']);
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
