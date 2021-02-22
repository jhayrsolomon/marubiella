<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_code
 * @property string $product_name
 * @property string $product_type
 * @property string $product_description
 * @property float $amount
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
            [['product_code', 'product_name', 'product_type', 'product_description', 'amount'], 'required'],
            [['amount'], 'number'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['product_code'], 'string', 'max' => 32],
            [['product_name', 'product_type'], 'string', 'max' => 250],
            [['product_description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'product_type' => 'Product Type',
            'product_description' => 'Product Description',
            'amount' => 'Amount',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
