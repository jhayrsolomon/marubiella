<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $or_number
 * @property int $division_id
 * @property int $fund_id
 * @property int $fund_type_id
 * @property int $customer_id
 * @property int $payment_type_id
 * @property float $total_amount
 * @property string $created_date
 * @property string $timestamp
 * @property int $status_id
 * @property string $remarks
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('cashier');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['or_number', 'division_id', 'fund_id', 'fund_type_id', 'customer_id', 'payment_type_id', 'total_amount', 'created_date', 'status_code', 'remarks'], 'required'],
            [['division_id', 'fund_id', 'fund_type_id', 'customer_id', 'payment_type_id'], 'integer'],
            [['total_amount'], 'number'],
            [['created_date', 'timestamp'], 'safe'],
            [['status_code','or_number'], 'string', 'max' => 50],
            [['remarks'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'or_number' => 'Or Number',
            'division_id' => 'Division ID',
            'fund_id' => 'Fund ID',
            'fund_type_id' => 'Fund Type ID',
            'customer_id' => 'Customer ID',
            'payment_type_id' => 'Payment Type ID',
            'total_amount' => 'Total Amount',
            'created_date' => 'Created Date',
            'timestamp' => 'Timestamp',
            'status_code' => 'Status Code',
            'remarks' => 'Remarks',
        ];
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['code' => 'status_code']);
    }
}
