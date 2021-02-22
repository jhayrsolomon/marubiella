<?php

namespace backend\modules\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property int $user_id
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property int $position_id
 * @property string $contact
 * @property string $email
 * @property int $div_id
 * @property int $status_id
 * @property string $created_date
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('agency');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fname', 'mname', 'lname', 'position_id', 'contact', 'email', 'div_id', 'status_id'], 'required'],
            [['user_id', 'position_id', 'div_id', 'status_id'], 'integer'],
            [['created_date'], 'safe'],
            [['fname', 'mname', 'lname', 'contact', 'email'], 'string', 'max' => 500],
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
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'position_id' => 'Position ID',
            'contact' => 'Contact Number',
            'email' => 'Email Address',
            'div_id' => 'Div ID',
            'status_id' => 'Status ID',
            'created_date' => 'Created Date',
        ];
    }
}
