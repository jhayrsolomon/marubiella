<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "or_series".
 *
 * @property int $id
 * @property int $category_id
 * @property string $start_or
 * @property string $next_or
 * @property string $end_or
 * @property int $status_id
 */
class OrSeries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'or_series';
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
            [['category_id', 'start_or', 'next_or', 'end_or', 'status_id'], 'required'],
            [['category_id', 'status_id'], 'integer'],
            [['start_or', 'next_or', 'end_or'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'start_or' => 'Start Or',
            'next_or' => 'Next Or',
            'end_or' => 'End Or',
            'status_id' => 'Status ID',
        ];
    }
    
    public function getCategory()
    {
        return $this->hasOne(OrCategory::className(), ['id' => 'category_id']);
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
