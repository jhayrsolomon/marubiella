<?php

namespace frontend\modules\models;

use Yii;

/**
 * This is the model class for table "employment_status".
 *
 * @property int $id
 * @property string $employment_status_code
 * @property string $employment_status_description
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_updated
 * @property string|null $date_deleted
 */
class EmploymentStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employment_status';
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
            [['employment_status_code', 'employment_status_description', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['employment_status_code'], 'string', 'max' => 10],
            [['employment_status_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employment_status_code' => 'Employment Status Code',
            'employment_status_description' => 'Employment Status Description',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
