<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employment_designation".
 *
 * @property int $id
 * @property string $employment_designation_code
 * @property string $employment_designation_code_description
 * @property string $employment_designation_job_description
 * @property int $is_active
 * @property string $date_created
 * @property string $date_updated
 * @property string|null $date_deleted
 */
class EmploymentDesignation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employment_designation';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('marubiella');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employment_designation_code', 'employment_designation_code_description', 'employment_designation_job_description'], 'required'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['employment_designation_code'], 'string', 'max' => 10],
            [['employment_designation_code_description'], 'string', 'max' => 500],
            [['employment_designation_job_description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employment_designation_code' => 'Employment Designation Code',
            'employment_designation_code_description' => 'Employment Designation Code Description',
            'employment_designation_job_description' => 'Employment Designation Job Description',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
