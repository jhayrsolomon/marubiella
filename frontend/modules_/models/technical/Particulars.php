<?php

namespace frontend\modules\models\technical;

use Yii;

/**
 * This is the model class for table "particulars".
 *
 * @property int $id
 * @property int $request_id
 * @property string $code
 * @property string $description
 * @property float $amount
 */
class Particulars extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'particulars';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('technical');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'code', 'description', 'amount'], 'required'],
            [['request_id'], 'integer'],
            [['amount'], 'number'],
            [['code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'code' => 'Code',
            'description' => 'Description',
            'amount' => 'Amount',
        ];
    }
}
