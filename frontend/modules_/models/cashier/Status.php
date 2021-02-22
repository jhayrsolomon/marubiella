<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $code
 * @property string $description
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
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
            [['code', 'description'], 'required'],
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
            'code' => 'Code',
            'description' => 'Description',
        ];
    }
}
