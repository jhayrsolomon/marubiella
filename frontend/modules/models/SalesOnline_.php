<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "sales_online".
 *
 * @property int $id
 * @property string $sales_code
 * @property string|null $sales_tracking_number
 * @property int|null $courier_id
 * @property int $employee_id
 * @property int $team_id
 * @property int $customer_id
 * @property int $customer_type_id
 * @property string $product_id
 * @property string $quantity
 * @property string $collectible_amount
 * @property float $total_amount
 * @property string $care_of
 * @property int $sales_status_id
 * @property string|null $osr_remark
 * @property string $page
 * @property int|null $csr_id
 * @property string|null $csr_remark
 * @property int|null $dispatcher_id
 * @property string|null $dispatcher_remark
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class SalesOnline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_online';
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
            [['sales_code', 'employee_id', 'team_id', 'customer_id', 'customer_type_id', 'product_id', 'quantity', 'collectible_amount', 'total_amount', 'care_of', 'sales_status_id', 'page'], 'required'],
            [['courier_id', 'employee_id', 'team_id', 'customer_id', 'customer_type_id', 'sales_status_id', 'csr_id', 'dispatcher_id', 'is_active'], 'integer'],
            [['total_amount'], 'number'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['sales_code', 'sales_tracking_number'], 'string', 'max' => 32],
            [['product_id', 'quantity', 'collectible_amount'], 'string', 'max' => 500],
            [['care_of', 'page'], 'string', 'max' => 250],
            [['osr_remark', 'csr_remark', 'dispatcher_remark'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_code' => 'Sales Code',
            'sales_tracking_number' => 'Sales Tracking Number',
            'courier_id' => 'Courier ID',
            'employee_id' => 'Employee ID',
            'team_id' => 'Team ID',
            'customer_id' => 'Customer ID',
            'customer_type_id' => 'Customer Type ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'collectible_amount' => 'Collectible Amount',
            'total_amount' => 'Total Amount',
            'care_of' => 'Care Of',
            'sales_status_id' => 'Sales Status ID',
            'osr_remark' => 'Osr Remark',
            'page' => 'Page',
            'csr_id' => 'Csr ID',
            'csr_remark' => 'Csr Remark',
            'dispatcher_id' => 'Dispatcher ID',
            'dispatcher_remark' => 'Dispatcher Remark',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
