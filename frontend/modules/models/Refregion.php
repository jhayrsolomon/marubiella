<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "refregion".
 *
 * @property int $id
 * @property string|null $psgcCode
 * @property string|null $regDesc
 * @property string|null $regCode
 */
class Refregion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refregion';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('psgc');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regDesc'], 'string'],
            [['psgcCode', 'regCode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'psgcCode' => 'Psgc Code',
            'regDesc' => 'Reg Desc',
            'regCode' => 'Reg Code',
        ];
    }
}
