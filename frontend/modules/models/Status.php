<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status_code
 * @property string $status_description
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
        return Yii::$app->get('marubiella');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_code', 'status_description'], 'required'],
            [['status_code'], 'string', 'max' => 10],
            [['status_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_code' => 'Status Code',
            'status_description' => 'Status Description',
        ];
    }
}
