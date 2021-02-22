<?php

namespace frontend\modules\models\ulims;

use Yii;

/**
 * This is the model class for table "customer_details".
 *
 * @property int $customerId
 * @property string $customerName
 * @property string $address
 * @property string $email
 */
class CustomerDetails extends \yii\db\ActiveRecord
{
    
    public static function primaryKey()
    {
        return ['customerId'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_details';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('ulims');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerId', 'customerName', 'address', 'email'], 'required'],
            [['customerId'], 'integer'],
            [['customerName', 'address'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customerId' => 'Customer ID',
            'customerName' => 'Customer Name',
            'address' => 'Address',
            'email' => 'Email',
        ];
    }
}
