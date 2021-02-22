<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $region_id
 * @property string $code
 * @property string $description
 *
 * @property Province[] $provinces
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
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
            [['code', 'description'], 'required'],
            [['code'], 'string', 'max' => 9],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'code' => 'Code',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Provinces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Province::className(), ['region_id' => 'region_id']);
    }
}
