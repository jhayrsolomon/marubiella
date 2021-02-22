<?php

namespace frontend\modules\models\accounting;

use Yii;

/**
 * This is the model class for table "collection_type".
 *
 * @property int $id
 * @property int $fund_id
 * @property string $collection_code
 * @property string $uacs
 * @property string $subject_code
 * @property string $uacs_desc
 * @property string $collection_name
 */
class CollectionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collection_type';
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
            [['fund_id', 'collection_code', 'uacs', 'subject_code', 'uacs_desc', 'collection_name'], 'required'],
            [['fund_id'], 'integer'],
            [['collection_code', 'uacs', 'subject_code'], 'string', 'max' => 100],
            [['uacs_desc', 'collection_name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fund_id' => 'Fund ID',
            'collection_code' => 'Collection Code',
            'uacs' => 'UACS',
            'subject_code' => 'Subject Code',
            'uacs_desc' => 'Uacs Desc',
            'collection_name' => 'Collection Name',
        ];
    }
    
    public function getFund()
    {
        return $this->hasOne(FundCluster::className(), ['id' => 'fund_id']);
    }
}
