<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "sales_product".
 *
 * @property int $id
 * @property int $sales_online_id
 * @property int $product_id
 * @property int $quantity
 * @property float $collectible_amount
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class SalesProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_product';
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
            [['sales_online_id', 'product_id', 'quantity', 'collectible_amount'], 'required'],
            [['sales_online_id', 'product_id', 'quantity', 'is_active'], 'integer'],
            [['collectible_amount'], 'number'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_online_id' => 'Sales Online ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'collectible_amount' => 'Collectible Amount',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
    
    public function getSalesonline()
    {
        return $this->hasOne(SalesOnline::className(), ['id' => 'sales_online_id']);
    }
}
