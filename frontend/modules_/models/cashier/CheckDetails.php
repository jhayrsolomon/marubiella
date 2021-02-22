<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "check_details".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $check_type_id
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $check_number
 * @property string $check_date
 * @property float $amount
 * @property string $revert_status_code
 * @property string $revert_reason
 */
class CheckDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_details';
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
            [['payment_id', 'check_type_id', 'bank_name', 'bank_branch', 'check_number', 'check_date', 'amount', 'revert_status_code', 'revert_reason'], 'required'],
            [['payment_id', 'check_type_id'], 'integer'],
            [['check_date'], 'safe'],
            [['amount'], 'number'],
            [['bank_name', 'bank_branch'], 'string', 'max' => 1000],
            [['check_number'], 'string', 'max' => 500],
            [['revert_status_code'], 'string', 'max' => 50],
            [['revert_reason'], 'string', 'max' => 10000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'check_type_id' => 'Check Type ID',
            'bank_name' => 'Bank Name',
            'bank_branch' => 'Bank Branch',
            'check_number' => 'Check Number',
            'check_date' => 'Check Date',
            'amount' => 'Amount',
            'revert_status_code' => 'Revert Status Code',
            'revert_reason' => 'Revert Reason',
        ];
    }
    
    public function getDetailsById($id)
    {
        $query = CheckDetails::find();
        $query->where(['payment_id' => $id]);
        
        return $query->all();
    }
}
