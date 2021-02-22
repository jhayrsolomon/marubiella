<?php

namespace frontend\modules\models\technical;

use Yii;

use frontend\modules\models\ulims\CustomerDetails;
use frontend\modules\models\agency\Division;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $reference_number
 * @property string $request_date
 * @property string $due_date
 * @property float $total_amount
 * @property int $customer_id
 * @property int $div_id
 * @property int $status_id
 * @property string $created_date
 * @property string $remarks
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('technical');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reference_number', 'request_date', 'due_date', 'total_amount', 'customer_id', 'div_id', 'status_id', 'remarks'], 'required'],
            [['request_date', 'due_date', 'created_date'], 'safe'],
            [['total_amount'], 'number'],
            [['customer_id', 'div_id', 'status_id'], 'integer'],
            [['reference_number'], 'string', 'max' => 500],
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
            'reference_number' => 'Reference Number',
            'request_date' => 'Request Date',
            'due_date' => 'Due Date',
            'total_amount' => 'Total Amount',
            'customer_id' => 'Customer ID',
            'div_id' => 'Div ID',
            'status_id' => 'Status ID',
            'created_date' => 'Created Date',
            'remarks' => 'Remarks',
        ];
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    
    public function getCustomerdetails()
    {
        return $this->hasOne(CustomerDetails::className(), ['customerId' => 'customer_id']);
    }
    
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'div_id']);
    }
}
