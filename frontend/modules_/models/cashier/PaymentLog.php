<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "payment_log".
 *
 * @property int $id
 * @property int $payment_id
 * @property string $updated_fields
 * @property int $updated_by
 * @property string $updated_date
 * @property string $remarks
 */
class PaymentLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_log';
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
            [['payment_id', 'updated_fields', 'updated_by', 'updated_date', 'remarks'], 'required'],
            [['payment_id', 'updated_by'], 'integer'],
            [['updated_date'], 'safe'],
            [['updated_fields'], 'string', 'max' => 1000],
            [['remarks'], 'string', 'max' => 500],
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
            'updated_fields' => 'Updated Fields',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'remarks' => 'Remarks',
        ];
    }
}
