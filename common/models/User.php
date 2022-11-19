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
class User extends \yii\db\ActiveRecord
{
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
}
