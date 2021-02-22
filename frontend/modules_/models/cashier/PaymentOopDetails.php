<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "payment_oop_details".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $oop_id
 */
class PaymentOopDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_oop_details';
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
            [['payment_id', 'oop_id'], 'required'],
            [['payment_id', 'oop_id'], 'integer'],
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
            'oop_id' => 'Oop ID',
        ];
    }
    
    public function getAllDetailsById($id)
    {
        $query = PaymentOopDetails::find();
        $query->where(['payment_id' => $id]);
        
        return $query->all();
    }
}
