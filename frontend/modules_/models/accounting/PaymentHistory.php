<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "payment_history".
 *
 * @property int $id
 * @property int $details_id
 * @property int $receipt_id
 */
class PaymentHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_history';
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
            [['details_id', 'receipt_id'], 'required'],
            [['details_id', 'receipt_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'details_id' => 'Details ID',
            'receipt_id' => 'Receipt ID',
        ];
    }
}
