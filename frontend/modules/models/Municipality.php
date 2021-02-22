<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "municipality".
 *
 * @property int $municipality_id
 * @property int $province_id
 * @property string $district
 * @property string $code
 * @property string $description
 *
 * @property Barangay[] $barangays
 * @property Province $province
 */
class Municipality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipality';
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
            [['province_id', 'district', 'code', 'description'], 'required'],
            [['province_id'], 'integer'],
            [['district'], 'string', 'max' => 10],
            [['code'], 'string', 'max' => 9],
            [['description'], 'string', 'max' => 255],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'province_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'municipality_id' => 'Municipality ID',
            'province_id' => 'Province ID',
            'district' => 'District',
            'code' => 'Code',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Barangays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarangays()
    {
        return $this->hasMany(Barangay::className(), ['municipality_id' => 'municipality_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
}
