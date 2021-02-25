<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $customer_code
 * @property string $customer_firstname
 * @property string|null $customer_middlename
 * @property string $customer_lastname
 * @property string $gender
 * @property string $age
 * @property int $customer_type_id
 * @property string $prefix_address
 * @property int $barangay_id
 * @property int $municipality_id
 * @property int $province_id
 * @property int $region_id
 * @property string $landmark
 * @property string $cellphone_number
 * @property string $telephone_number
 * @property int $customer_status_id
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
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
            [['customer_code', 'customer_firstname', 'customer_lastname', 'gender', 'age', 'customer_type_id', 'prefix_address', 'barangay_id', 'municipality_id', 'province_id', 'region_id', 'landmark', 'cellphone_number', 'telephone_number', 'customer_status_id'], 'required'],
            [['customer_type_id', 'barangay_id', 'municipality_id', 'province_id', 'region_id', 'customer_status_id', 'is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['customer_code'], 'string', 'max' => 32],
            [['customer_firstname', 'customer_middlename', 'customer_lastname', 'gender'], 'string', 'max' => 250],
            [['age'], 'string', 'max' => 11],
            [['prefix_address', 'landmark'], 'string', 'max' => 1000],
            [['cellphone_number'], 'string', 'max' => 13],
            [['telephone_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_code' => 'Customer Code',
            'customer_firstname' => 'Customer Firstname',
            'customer_middlename' => 'Customer Middlename',
            'customer_lastname' => 'Customer Lastname',
            'gender' => 'Gender',
            'age' => 'Age',
            'customer_type_id' => 'Customer Type ID',
            'prefix_address' => 'Prefix Address',
            'barangay_id' => 'Barangay ID',
            'municipality_id' => 'Municipality ID',
            'province_id' => 'Province ID',
            'region_id' => 'Region ID',
            'landmark' => 'Landmark',
            'cellphone_number' => 'Cellphone Number',
            'telephone_number' => 'Telephone Number',
            'customer_status_id' => 'Customer Status ID',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
