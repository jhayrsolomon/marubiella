<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "payment_particulars".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $mode_of_payment_id
 * @property float $general_amount
 * @property float $trust_amount
 */
class PaymentParticulars extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_particulars';
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
            [['payment_id', 'mode_of_payment_id', 'general_amount', 'trust_amount'], 'required'],
            [['payment_id', 'mode_of_payment_id'], 'integer'],
            [['general_amount', 'trust_amount'], 'number'],
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
            'mode_of_payment_id' => 'Mode Of Payment ID',
            'general_amount' => 'General Amount',
            'trust_amount' => 'Trust Amount',
        ];
    }
    
    public function getAllDetailsById($id)
    {
        $query = PaymentParticulars::find();
        $query->where(['payment_id' => $id]);
        
        return $query->all();
    }
}
