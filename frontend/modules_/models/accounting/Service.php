<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property int $fund_id
 * @property string $service_code
 * @property string $uacs
 * @property string $subject_code
 * @property string $uacs_desc
 * @property string $service_title
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
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
            [['fund_id', 'service_code', 'uacs', 'subject_code', 'uacs_desc', 'service_title'], 'required'],
            [['fund_id'], 'integer'],
            [['service_code', 'uacs', 'subject_code'], 'string', 'max' => 100],
            [['uacs_desc', 'service_title'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fund_id' => 'Fund ID',
            'service_code' => 'Service Code',
            'uacs' => 'Uacs',
            'subject_code' => 'Subject Code',
            'uacs_desc' => 'Uacs Desc',
            'service_title' => 'Service Title',
        ];
    }
    
    public function getFund()
    {
        return $this->hasOne(FundCluster::className(), ['id' => 'fund_id']);
    }
}
