<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property int|null $branch_id
 * @property int $role_id
 * @property int|null $status
 * @property int|null $state
 * @property int $type_id
 *
 * @property Attendance[] $attendances
 * @property Branch $branch
 * @property GroupTeacher[] $groupTeachers
 * @property Groups[] $groups
 * @property Groups[] $groups0
 * @property Pay[] $pays
 * @property Pay[] $pays0
 * @property UserRole $role
 * @property Student[] $students
 * @property UserType $type
 */
class User extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'role_id', 'status', 'state', 'type_id'], 'integer'],
            [['role_id', 'type_id'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::class, 'targetAttribute' => ['role_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'username' => 'Username',
            'password' => 'Password',
            'branch_id' => 'Branch ID',
            'role_id' => 'Role ID',
            'status' => 'Status',
            'state' => 'State',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * Gets query for [[Attendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::class, ['teacher_id' => 'id']);
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
     * Gets query for [[GroupTeachers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTeachers()
    {
        return $this->hasMany(GroupTeacher::class, ['teacher_id' => 'id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::class, ['creator_id' => 'id']);
    }

    /**
     * Gets query for [[Groups0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups0()
    {
        return $this->hasMany(Groups::class, ['id' => 'group_id'])->viaTable('group_teacher', ['teacher_id' => 'id']);
    }

    /**
     * Gets query for [[Pays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays()
    {
        return $this->hasMany(Pay::class, ['consept_id' => 'id']);
    }

    /**
     * Gets query for [[Pays0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays0()
    {
        return $this->hasMany(Pay::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRole::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['creator_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(UserType::class, ['id' => 'type_id']);
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
