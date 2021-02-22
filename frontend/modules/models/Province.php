<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property int $province_id
 * @property int $region_id
 * @property string $code
 * @property string $description
 *
 * @property Municipality[] $municipalities
 * @property Region $region
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
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
            [['region_id', 'code', 'description'], 'required'],
            [['region_id'], 'integer'],
            [['code'], 'string', 'max' => 9],
            [['description'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'region_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'province_id' => 'Province ID',
            'region_id' => 'Region ID',
            'code' => 'Code',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Municipalities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalities()
    {
        return $this->hasMany(Municipality::className(), ['province_id' => 'province_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['region_id' => 'region_id']);
    }
}
