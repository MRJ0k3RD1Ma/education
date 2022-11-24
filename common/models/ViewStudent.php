<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_student".
 *
 * @property string $group_name
 * @property int $group_id
 * @property int $person_id
 * @property string $person_name
 * @property string|null $person_phone
 * @property string|null $person_parent_phone
 * @property int $id
 * @property string $code
 * @property int $social_id
 * @property int $project_id
 * @property string|null $created
 * @property string|null $updated
 * @property int $branch_id
 * @property int|null $status
 */
class ViewStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'person_id', 'id', 'social_id', 'project_id', 'branch_id', 'status'], 'integer'],
            [['code', 'social_id', 'project_id', 'branch_id'], 'required'],
            [['created', 'updated'], 'safe'],
            [['group_name', 'person_phone', 'person_parent_phone', 'code'], 'string', 'max' => 255],
            [['person_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_name' => 'Group Name',
            'group_id' => 'Group ID',
            'person_id' => 'Person ID',
            'person_name' => 'Person Name',
            'person_phone' => 'Person Phone',
            'person_parent_phone' => 'Person Parent Phone',
            'id' => 'ID',
            'code' => 'Code',
            'social_id' => 'Social ID',
            'project_id' => 'Project ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'branch_id' => 'Branch ID',
            'status' => 'Status',
        ];
    }
}
