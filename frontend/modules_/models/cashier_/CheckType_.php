<?php

namespace frontend\modules\models\cashier;

use Yii;

/**
 * This is the model class for table "check_type".
 *
 * @property int $id
 * @property string $check_code
 * @property string $description
 */
class CheckType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_type';
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
            [['check_code', 'description'], 'required'],
            [['check_code'], 'string', 'max' => 50],
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
            'check_code' => 'Check Code',
            'description' => 'Description',
        ];
    }
}
