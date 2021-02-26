<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $user_code
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $cellphone_number
 * @property string|null $telephone_number
 * @property string $date_of_birth
 * @property int $is_active
 * @property int $status_id
 * @property string $date_created
 * @property string $date_updated
 * @property string|null $date_deleted
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
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
            [['user_id', 'is_active', 'status_id'], 'integer'],
            [['firstname', 'middlename', 'lastname', 'cellphone_number', 'date_of_birth', 'status_id'], 'required'],
            [['date_of_birth', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['user_code'], 'string', 'max' => 32],
            [['firstname', 'middlename', 'lastname'], 'string', 'max' => 250],
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
            'user_id' => 'User ID',
            'user_code' => 'User Code',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'cellphone_number' => 'Cellphone Number',
            'telephone_number' => 'Telephone Number',
            'date_of_birth' => 'Date Of Birth',
            'is_active' => 'Is Active',
            'status_id' => 'Status ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
    
    /*public function getAffiliation()
    {
        return $this->hasOne(EmployeeAffiliation::className(), ['id' => 'employee_affiliation_id']);
    }
    
    public function getAddress()
    {
        return $this->hasOne(EmployeeAddress::className(), ['id' => 'employee_address_id']);
    }*/
}
