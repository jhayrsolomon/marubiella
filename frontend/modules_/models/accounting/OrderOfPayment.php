<?php

namespace frontend\modules\models\accounting;

use Yii;
use frontend\modules\models\ulims\CustomerDetails;
use frontend\modules\models\cashier\PaymentType;

/**
 * This is the model class for table "order_of_payment".
 *
 * @property int $id
 * @property string $transaction_num
 * @property int $oop_type_id
 * @property int $customer_id
 * @property int $fund_id
 * @property int $type_id
 * @property float $total_amount
 * @property float $total_balance
 * @property int $oop_status_id
 * @property string $oop_date
 * @property string $create_time
 * @property string $remarks
 */
class OrderOfPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_of_payment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('accounting');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_num', 'payment_method_id', 'oop_type_id', 'customer_id', 'division_id', 'fund_id', 'type_id', 'total_amount', 'total_balance', 'oop_status_id', 'payment_status_id', 'oop_date', 'remarks'], 'required'],
            [['payment_method_id', 'oop_type_id', 'customer_id', 'division_id', 'fund_id', 'type_id', 'oop_status_id', 'payment_status_id'], 'integer'],
            [['total_amount', 'total_balance'], 'number'],
            [['oop_date', 'create_time'], 'safe'],
            [['transaction_num'], 'string', 'max' => 100],
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
            'transaction_num' => 'OOP Reference Number',
            'payment_method_id' => 'Payment Method',
            'oop_type_id' => 'Oop Type ID',
            'customer_id' => 'Customer ID',
            'division_id' => 'Division ID',
            'fund_id' => 'Fund ID',
            'type_id' => 'Type ID',
            'total_amount' => 'Total Amount',
            'total_balance' => 'Total Balance',
            'oop_status_id' => 'OOP Status ID',
            'payment_status_id' => 'Payment Status ID',
            'oop_date' => 'OOP Date',
            'create_time' => 'Create Time',
            'remarks' => 'Remarks',
        ];
    }
    
    public function getCustomerdetails()
    {
        return $this->hasOne(CustomerDetails::className(), ['customerId' => 'customer_id']);
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'oop_status_id']);
    }
    
    public function getPaymentstatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'payment_status_id']);
    }
    
    public function getFund()
    {
        return $this->hasOne(FundCluster::className(), ['id' => 'fund_id']);
    }
    
    public function getOopdetails()
    {
        return $this->hasMany(OopDetails::className(), ['op_id' => 'id']);
    }
    public function getPaymentmethod()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_method_id']);
    }
    
    
}
