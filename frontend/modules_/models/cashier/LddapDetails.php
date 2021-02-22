<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "lddap_details".
 *
 * @property int $id
 * @property int $payment_id
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $lddap_number
 * @property string $lddap_date
 * @property float $lddap_amount
 */
class LddapDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lddap_details';
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
            [['payment_id', 'bank_name', 'bank_branch', 'lddap_number', 'lddap_date', 'lddap_amount'], 'required'],
            [['payment_id'], 'integer'],
            [['lddap_date'], 'safe'],
            [['lddap_amount'], 'number'],
            [['bank_name', 'bank_branch'], 'string', 'max' => 1000],
            [['lddap_number'], 'string', 'max' => 500],
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
            'bank_name' => 'Bank Name',
            'bank_branch' => 'Bank Branch',
            'lddap_number' => 'Lddap Number',
            'lddap_date' => 'Lddap Date',
            'lddap_amount' => 'Lddap Amount',
        ];
    }
    
    public function getDetailsById($id)
    {
        $query = LddapDetails::find();
        $query->where(['payment_id' => $id]);
        
        return $query->all();
    }
}
