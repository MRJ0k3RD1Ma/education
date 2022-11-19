<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $name
 * @property int $branch_id
 * @property int $course_id
 * @property int|null $status_id
 * @property string|null $start_date
 * @property int|null $day_id
 * @property string|null $time
 * @property int $type_id
 * @property int|null $price
 * @property string|null $created
 * @property string|null $updated
 * @property int $creator_id
 * @property int|null $room_id
 *
 * @property Attendance[] $attendances
 * @property Branch $branch
 * @property Cource $course
 * @property User $creator
 * @property GroupDay $day
 * @property GroupTeacher[] $groupTeachers
 * @property Room $room
 * @property GroupStatus $status
 * @property Student[] $students
 * @property User[] $teachers
 * @property GroupType $type
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'course_id', 'type_id', 'creator_id'], 'required'],
            [['branch_id', 'course_id', 'status_id', 'day_id', 'type_id', 'price', 'creator_id', 'room_id'], 'integer'],
            [['start_date', 'created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 10],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cource::class, 'targetAttribute' => ['course_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupDay::class, 'targetAttribute' => ['day_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'branch_id' => 'Branch ID',
            'course_id' => 'Course ID',
            'status_id' => 'Status ID',
            'start_date' => 'Start Date',
            'day_id' => 'Day ID',
            'time' => 'Time',
            'type_id' => 'Type ID',
            'price' => 'Price',
            'created' => 'Created',
            'updated' => 'Updated',
            'creator_id' => 'Creator ID',
            'room_id' => 'Room ID',
        ];
    }

    /**
     * Gets query for [[Attendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::class, ['group_id' => 'id']);
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
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Cource::class, ['id' => 'course_id']);
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
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(GroupDay::class, ['id' => 'day_id']);
    }

    /**
     * Gets query for [[GroupTeachers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTeachers()
    {
        return $this->hasMany(GroupTeacher::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(GroupStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Teachers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(User::class, ['id' => 'teacher_id'])->viaTable('group_teacher', ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(GroupType::class, ['id' => 'type_id']);
    }
}
