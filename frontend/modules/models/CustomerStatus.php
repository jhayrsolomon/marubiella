<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "customer_status".
 *
 * @property int $id
 * @property string $customer_status_code
 * @property string $customer_status_name
 * @property string $customer_status_description
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class CustomerStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('marubiella');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_status_code', 'customer_status_name', 'customer_status_description'], 'required'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['customer_status_code'], 'string', 'max' => 32],
            [['customer_status_name'], 'string', 'max' => 250],
            [['customer_status_description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_status_code' => 'Customer Status Code',
            'customer_status_name' => 'Customer Status Name',
            'customer_status_description' => 'Customer Status Description',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
