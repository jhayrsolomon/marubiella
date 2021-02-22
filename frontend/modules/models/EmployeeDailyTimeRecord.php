<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employee_daily_time_record".
 *
 * @property int $id
 * @property int $user_id
 * @property int $employee_id
 * @property string $today_date
 * @property string $in_out
 * @property string $time_report
 * @property string $remark
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class EmployeeDailyTimeRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_daily_time_record';
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
            [['user_id', 'employee_id', 'today_date', 'in_out', 'time_report', 'remark'], 'required'],
            [['user_id', 'employee_id'], 'integer'],
            [['today_date', 'time_report', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['in_out'], 'string', 'max' => 3],
            [['remark'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'employee_id' => 'Employee ID',
            'today_date' => 'Today Date',
            'in_out' => 'In Out',
            'time_report' => 'Time Report',
            'remark' => 'Remark',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
