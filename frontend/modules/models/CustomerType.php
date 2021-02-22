<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "customer_type".
 *
 * @property int $id
 * @property string $customer_type_code
 * @property string $customer_type_name
 * @property string $customer_type_description
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class CustomerType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_type';
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
            [['customer_type_code', 'customer_type_name', 'customer_type_description'], 'required'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['customer_type_code', 'customer_type_name'], 'string', 'max' => 250],
            [['customer_type_description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_type_code' => 'Customer Type Code',
            'customer_type_name' => 'Customer Type Name',
            'customer_type_description' => 'Customer Type Description',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
