<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "payment_type".
 *
 * @property int $id
 * @property string $type_code
 * @property string $description
 * @property string $action
 */
class PaymentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_type';
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
            [['type_code', 'description', 'action'], 'required'],
            [['type_code'], 'string', 'max' => 50],
            [['description', 'action'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_code' => 'Type Code',
            'description' => 'Description',
            'action' => 'Action',
        ];
    }
}
