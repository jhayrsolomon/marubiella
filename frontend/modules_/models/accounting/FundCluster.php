<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "fund_cluster".
 *
 * @property int $id
 * @property string $fund_code
 * @property string $fund_name
 * @property string $description
 */
class FundCluster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fund_cluster';
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
            [['fund_code', 'fund_name', 'description'], 'required'],
            [['fund_code'], 'string', 'max' => 100],
            [['fund_name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fund_code' => 'Fund Code',
            'fund_name' => 'Fund Name',
            'description' => 'Description',
        ];
    }
}
