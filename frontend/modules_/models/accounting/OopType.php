<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "oop_type".
 *
 * @property int $id
 * @property string $type_code
 * @property string $description
 */
class OopType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oop_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('accounting');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_code', 'description'], 'required'],
            [['type_code'], 'string', 'max' => 50],
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
            'type_code' => 'Type Code',
            'description' => 'Description',
        ];
    }
}
