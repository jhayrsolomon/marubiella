<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "barangay".
 *
 * @property int $barangay_id
 * @property int $municipality_id
 * @property string $code
 * @property string $description
 *
 * @property Municipality $municipality
 */
class Barangay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barangay';
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
            [['municipality_id', 'code', 'description'], 'required'],
            [['municipality_id'], 'integer'],
            [['code'], 'string', 'max' => 9],
            [['description'], 'string', 'max' => 255],
            [['municipality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipality::className(), 'targetAttribute' => ['municipality_id' => 'municipality_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'barangay_id' => 'Barangay ID',
            'municipality_id' => 'Municipality ID',
            'code' => 'Code',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Municipality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipality()
    {
        return $this->hasOne(Municipality::className(), ['municipality_id' => 'municipality_id']);
    }
}
