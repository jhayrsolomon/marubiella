<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "ldc_series".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $fund_id
 * @property string $ldc_code
 * @property string $ldc_date
 */
class LdcSeries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ldc_series';
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
            [['payment_id', 'fund_id', 'ldc_code', 'ldc_date'], 'required'],
            [['payment_id', 'fund_id'], 'integer'],
            [['ldc_date'], 'safe'],
            [['ldc_code'], 'string', 'max' => 50],
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
            'fund_id' => 'Fund ID',
            'ldc_code' => 'Ldc Code',
            'ldc_date' => 'Ldc Date',
        ];
    }
}
