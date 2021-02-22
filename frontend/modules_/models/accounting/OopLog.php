<?php

namespace frontend\modules\models\accounting;

use Yii;
use frontend\modules\models\agency\Staff;

/**
 * This is the model class for table "oop_log".
 *
 * @property int $id
 * @property int $oop_id
 * @property string $updated_fields
 * @property int $updated_by
 * @property string $updated_date
 * @property string $remarks
 */
class OopLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oop_log';
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
            [['oop_id', 'updated_fields', 'updated_by', 'remarks'], 'required'],
            [['oop_id', 'updated_by'], 'integer'],
            [['updated_date'], 'safe'],
            [['updated_fields', 'remarks'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oop_id' => 'Oop ID',
            'updated_fields' => 'Updated Fields',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'remarks' => 'Remarks',
        ];
    }
    
    public function getOop()
    {
        return $this->hasOne(OrderOfPayment::className(), ['id' => 'oop_id']);
    }
    
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['user_id' => 'updated_by']);
    }
}
