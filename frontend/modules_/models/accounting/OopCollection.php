<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "oop_collection".
 *
 * @property int $id
 * @property int $oop_details_id
 * @property float $general_fund
 * @property float $trust_fund
 */
class OopCollection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oop_collection';
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
            [['oop_details_id', 'general_fund', 'trust_fund'], 'required'],
            [['oop_details_id'], 'integer'],
            [['general_fund', 'trust_fund'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oop_details_id' => 'Oop Details ID',
            'general_fund' => 'General Fund',
            'trust_fund' => 'Trust Fund',
        ];
    }
}
