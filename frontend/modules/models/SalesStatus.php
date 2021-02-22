<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "sales_status".
 *
 * @property int $id
 * @property string $sales_status_code
 * @property string $sales_status_name
 * @property string $sales_status_description
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class SalesStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_status';
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
            [['sales_status_code', 'sales_status_name', 'sales_status_description'], 'required'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['sales_status_code'], 'string', 'max' => 32],
            [['sales_status_name'], 'string', 'max' => 250],
            [['sales_status_description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_status_code' => 'Sales Status Code',
            'sales_status_name' => 'Sales Status Name',
            'sales_status_description' => 'Sales Status Description',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
