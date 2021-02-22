<?php

namespace frontend\modules\models\technical;

use Yii;

/**
 * This is the model class for table "request_log".
 *
 * @property int $id
 * @property int $request_id
 * @property string $updated_fields
 * @property int $updated_by
 * @property string $updated_date
 * @property string $remarks
 */
class RequestLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_log';
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
            [['request_id', 'updated_fields', 'updated_by', 'remarks'], 'required'],
            [['request_id', 'updated_by'], 'integer'],
            [['updated_date'], 'safe'],
            [['updated_fields', 'remarks'], 'string', 'max' => 1000],
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
            'updated_fields' => 'Updated Fields',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'remarks' => 'Remarks',
        ];
    }
}
