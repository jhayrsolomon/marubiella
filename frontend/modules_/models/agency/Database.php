<?php

namespace frontend\modules\models\agency;

use Yii;

/**
 * This is the model class for table "database".
 *
 * @property int $id
 * @property string $code
 * @property string $model
 */
class Database extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'database';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('agency');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'model'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['model'], 'string', 'max' => 500],
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
            'model' => 'Model',
        ];
    }
}
