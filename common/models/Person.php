<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string|null $pnfl
 * @property string|null $inn
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $phone_parent
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Student[] $students
 */
class Person extends \yii\db\ActiveRecord
{
    public $checked,$analitics;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['pnfl', 'inn', 'birthday', 'phone', 'phone_parent'], 'string', 'max' => 255],
            ['pnfl','string','length'=>14],
            ['inn','string','length'=>9],
            [['checked','branch_id'],'integer'],
            [['analitics'],'each','rule'=>['integer']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'FIO',
            'pnfl' => 'JSHSHIR(PNFL)',
            'inn' => 'STIR(INN)',
            'birthday' => 'Tug`ilgan kuni',
            'phone' => 'Telefon',
            'phone_parent' => 'Ota-onasining telefoni',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'checked'=>'Guruhga yozilish',
            'analitics'=>'',
            'branch_id'=>'Filial'
        ];
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['person_id' => 'id']);
    }
    public function getBranch(){
        return $this->hasOne(Branch::className(),['id'=>'branch_id']);
    }

    public function getCourse(){
        return $this->hasMany(PersonWish::className(),['person_id'=>'id'])->andWhere(['branch_id'=>Yii::$app->user->identity->branch_id]);
    }
}
