<?php

namespace frontend\modules\models\accounting;

use Yii;
use frontend\modules\models\ulims\Request as UlimsRequest;
use frontend\modules\models\technical\Request as TsRequest;

/**
 * This is the model class for table "oop_details".
 *
 * @property int $id
 * @property int $op_id
 * @property int $request_id
 * @property int $division_id
 * @property float $amount
 * @property float $balance
 * @property int $status_id
 */
class OopDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oop_details';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('accounting');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['op_id', 'request_id', 'division_id', 'amount', 'balance', 'status_id'], 'required'],
            [['op_id', 'request_id', 'division_id', 'status_id'], 'integer'],
            [['amount', 'balance'], 'number'],
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
            'request_id' => 'Request ID',
            'division_id' => 'Division ID',
            'amount' => 'Amount',
            'balance' => 'Balance',
            'status_id' => 'Status ID',
        ];
    }
    
    public function getUlimsequest()
    {
        return $this->hasOne(UlimsRequest::className(), ['id' => 'request_id']);
    }
    
    public function getTsrequest()
    {
        return $this->hasOne(TsRequest::className(), ['id' => 'request_id']);
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    
    public function getOopcollection()
    {
        return $this->hasMany(Status::className(), ['oop_details_id' => 'id']);
    }
}
