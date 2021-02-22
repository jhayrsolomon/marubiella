<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employee_affiliation".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $employment_designation_id
 * @property int $employment_status_id
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class EmployeeAffiliation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_affiliation';
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
            [['employee_id', 'employment_designation_id', 'employment_status_id'], 'required'],
            [['employee_id', 'employment_designation_id', 'employment_status_id', 'is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'employment_designation_id' => 'Employment Designation ID',
            'employment_status_id' => 'Employment Status ID',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
