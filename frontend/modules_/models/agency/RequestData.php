<?php

namespace frontend\modules\models\agency;

use Yii;

/**
 * This is the model class for table "request_data".
 *
 * @property int $id
 * @property string $code
 * @property string $type_code
 * @property string $model
 */
class RequestData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_data';
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
            [['code', 'type_code', 'model', 'request_num'], 'required'],
            [['code', 'type_code', 'request_num'], 'string', 'max' => 50],
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
            'type_code' => 'Type Code',
            'model' => 'Model',
            'request_num' => 'Request Number',
        ];
    }
}
