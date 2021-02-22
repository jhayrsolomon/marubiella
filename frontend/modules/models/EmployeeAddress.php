<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employee_address".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $prefix_address
 * @property int $barangay_id
 * @property int $municipality_id
 * @property int $province_id
 * @property int $region_id
 * @property int $is_active
 * @property string $date_created
 * @property string $date_updated
 * @property string|null $date_deleted
 */
class EmployeeAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_address';
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
            [['employee_id', 'prefix_address', 'barangay_id', 'municipality_id', 'province_id', 'region_id'], 'required'],
            [['employee_id', 'barangay_id', 'municipality_id', 'province_id', 'region_id', 'is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['prefix_address'], 'string', 'max' => 1000],
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
            'prefix_address' => 'Prefix Address',
            'barangay_id' => 'Barangay ID',
            'municipality_id' => 'Municipality ID',
            'province_id' => 'Province ID',
            'region_id' => 'Region ID',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
