<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property int $op_id
 * @property string $or_num
 * @property int $mode_of_payment_id
 * @property string $date
 * @property string $created_date
 * @property int $status_id
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
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
            [['op_id', 'or_num', 'mode_of_payment_id', 'date', 'status_id'], 'required'],
            [['op_id', 'mode_of_payment_id', 'status_id'], 'integer'],
            [['date', 'created_date'], 'safe'],
            [['or_num'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'op_id' => 'Op ID',
            'or_num' => 'Or Num',
            'mode_of_payment_id' => 'Mode Of Payment ID',
            'date' => 'Date',
            'created_date' => 'Created Date',
            'status_id' => 'Status ID',
        ];
    }
}
