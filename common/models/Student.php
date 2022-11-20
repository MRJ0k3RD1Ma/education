<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $group_id
 * @property int $person_id
 * @property int $social_id
 * @property int $project_id
 * @property string|null $created
 * @property string|null $updated
 * @property int $creator_id
 * @property int|null $status
 *
 * @property Attendance[] $attendances
 * @property User $creator
 * @property Groups $group
 * @property Pay[] $pays
 * @property Person $person
 * @property Project $project
 * @property PersonSocial $social
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
//            [['group_id', 'person_id', 'social_id', 'project_id', 'creator_id'], 'required'],

            [['group_id','code_id', 'person_id', 'social_id', 'project_id', 'creator_id', 'status'], 'integer'],
            [['created', 'updated','code'], 'safe'],
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
            'id' => 'ID',
            'group_id' => 'Guruh nomi',
            'person_id' => 'O`quvchi',
            'social_id' => 'Ijtimoiy mavqei',
            'project_id' => 'Loyiha nomi',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'creator_id' => 'Yaratuvchi',
            'status' => 'Status',
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
     * Gets query for [[Pays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays()
    {
        return $this->hasMany(Pay::class, ['student_id' => 'id']);
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
}
