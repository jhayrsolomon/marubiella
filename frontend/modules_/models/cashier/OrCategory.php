<?php

namespace frontend\modules\models\cashier;

use Yii;
use frontend\modules\models\accounting\FundCluster;

/**
 * This is the model class for table "or_category".
 *
 * @property int $id
 * @property int $fund_id
 * @property string $category
 */
class OrCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'or_category';
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
            [['fund_id', 'category'], 'required'],
            [['fund_id'], 'integer'],
            [['category'], 'string', 'max' => 500],
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
            'category' => 'Category',
        ];
    }
    
    public function getFund()
    {
        return $this->hasOne(FundCluster::className(), ['id' => 'fund_id']);
    }
}
