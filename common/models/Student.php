<?php

namespace common\models;

use app\models\StudentType;
use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $code
 * @property int $code_id
 * @property int $group_id
 * @property int $person_id
 * @property int $social_id
 * @property int $project_id
 * @property string|null $created
 * @property string|null $end_date
 * @property string|null $updated
 * @property int $creator_id
 * @property int $branch_id
 * @property int|null $status
 * @property int|null $type_id
 * @property int|null $student_social_id
 *
 * @property Attendance[] $attendances
 * @property Branch $branch
 * @property User $creator
 * @property Groups $group
 * @property Person $person
 * @property Project $project
 * @property PersonSocial $social
 * @property StudentPay[] $studentPays
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'code_id', 'group_id', 'person_id', 'social_id', 'project_id', 'creator_id', 'branch_id'], 'required'],
            [['code_id', 'group_id', 'person_id', 'social_id','type_id', 'project_id', 'creator_id', 'branch_id', 'status','student_social_id'], 'integer'],
            [['created', 'updated','end_date'], 'safe'],
            [['code'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['social_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonSocial::class, 'targetAttribute' => ['social_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Kod',
            'code_id' => 'Kod',
            'branch_id' => 'Filial',
            'id' => 'ID',
            'type_id' => 'Tashkilot turi',
            'group_id' => 'Guruh nomi',
            'person_id' => 'O`quvchi',
            'social_id' => 'Mahsus ijtimoiy status',
            'project_id' => 'Loyiha nomi',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'creator_id' => 'Yaratuvchi',
            'end_date' => 'Tugatgan sanasi',
            'status' => 'Status',
            'student_social_id' => 'Ijtimoiy status',
        ];
    }

    /**
     * Gets query for [[Attendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::class, ['student_id' => 'id']);
    }

    public function getStudentSocial(){
        return $this->hasOne(StudentSocial::className(),['id'=>'student_social_id']);
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

    public function getType(){
        return $this->hasOne(WorkType::className(),['id'=>'type_id']);
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
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Social]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(PersonSocial::class, ['id' => 'social_id']);
    }

    /**
     * Gets query for [[StudentPays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPays()
    {
        return $this->hasMany(StudentPay::class, ['student_id' => 'id']);
    }
}
