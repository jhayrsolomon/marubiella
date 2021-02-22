<?php

namespace frontend\modules\models\portal;

use Yii;

/**
 * This is the model class for table "e_payment".
 *
 * @property int $id
 * @property string $merchant_code
 * @property string $merchant_reference_number
 * @property string $particulars
 * @property string $transaction_type
 * @property float $total_amount
 * @property int $status_id
 * @property string $created_date
 * @property string $timestamp
 */
class EPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'e_payment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('portal');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_code', 'merchant_reference_number', 'particulars', 'transaction_type', 'total_amount', 'status_id', 'created_date'], 'required'],
            [['total_amount'], 'number'],
            [['status_id'], 'integer'],
            [['created_date', 'timestamp'], 'safe'],
            [['merchant_code', 'merchant_reference_number', 'transaction_type'], 'string', 'max' => 50],
            [['particulars'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_code' => 'Merchant Code',
            'merchant_reference_number' => 'Merchant Reference Number',
            'particulars' => 'Particulars',
            'transaction_type' => 'Transaction Type',
            'total_amount' => 'Total Amount',
            'status_id' => 'Status ID',
            'created_date' => 'Created Date',
            'timestamp' => 'Timestamp',
        ];
    }
}
