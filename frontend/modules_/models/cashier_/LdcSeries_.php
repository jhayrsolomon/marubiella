<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "ldc_series".
 *
 * @property int $id
 * @property int $receipt_id
 * @property int $fund_id
 * @property string $ldc_code
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
            [['receipt_id', 'fund_id', 'ldc_code'], 'required'],
            [['receipt_id', 'fund_id'], 'integer'],
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
            'receipt_id' => 'Receipt ID',
            'fund_id' => 'Fund ID',
            'ldc_code' => 'Ldc Code',
        ];
    }
}
