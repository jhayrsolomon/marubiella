<?php

namespace frontend\modules\models\ulims;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $requestRefNum
 * @property string $requestId
 * @property string $requestDate
 * @property string $requestTime
 * @property int $rstl_id
 * @property int $labId
 * @property int $sublabId
 * @property int $customerId
 * @property int $paymentType
 * @property int $discount
 * @property int $purposeId
 * @property string $idPresented
 * @property string $validity
 * @property string $idNumber
 * @property int $orId
 * @property float $total
 * @property string|null $reportDue
 * @property string $conforme
 * @property string $conformeGender
 * @property string $receivedBy
 * @property int|null $mode_release
 * @property string $modeofreleaseId
 * @property int $returnSample
 * @property int $return_samples
 * @property string|null $notes
 * @property int $cancelled
 * @property string|null $reported
 * @property string|null $analysts
 * @property string|null $remarks
 * @property string $remark
 * @property string $additionalAddress
 * @property string|null $man_hour
 * @property int|null $determination
 * @property string|null $released
 * @property string $create_time
 * @property int $completed
 * @property string $otherrequestId
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('ulims');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requestRefNum', 'requestId', 'requestDate', 'requestTime', 'rstl_id', 'labId', 'sublabId', 'customerId', 'paymentType', 'discount', 'purposeId', 'idPresented', 'validity', 'idNumber', 'orId', 'total', 'conforme', 'conformeGender', 'receivedBy', 'modeofreleaseId', 'returnSample', 'cancelled', 'remark', 'additionalAddress', 'completed', 'otherrequestId'], 'required'],
            [['requestDate', 'reportDue', 'reported', 'released', 'create_time'], 'safe'],
            [['rstl_id', 'labId', 'sublabId', 'customerId', 'paymentType', 'discount', 'purposeId', 'orId', 'mode_release', 'returnSample', 'return_samples', 'cancelled', 'determination', 'completed'], 'integer'],
            [['total'], 'number'],
            [['notes', 'remarks'], 'string'],
            [['requestRefNum', 'requestId', 'idPresented', 'validity', 'idNumber', 'conforme', 'conformeGender', 'receivedBy', 'modeofreleaseId', 'otherrequestId'], 'string', 'max' => 50],
            [['requestTime'], 'string', 'max' => 25],
            [['analysts'], 'string', 'max' => 256],
            [['remark'], 'string', 'max' => 1000],
            [['additionalAddress'], 'string', 'max' => 200],
            [['man_hour'], 'string', 'max' => 8],
            [['requestRefNum', 'requestId'], 'unique', 'targetAttribute' => ['requestRefNum', 'requestId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requestRefNum' => 'Request Ref Num',
            'requestId' => 'Request ID',
            'requestDate' => 'Request Date',
            'requestTime' => 'Request Time',
            'rstl_id' => 'Rstl ID',
            'labId' => 'Lab ID',
            'sublabId' => 'Sublab ID',
            'customerId' => 'Customer ID',
            'paymentType' => 'Payment Type',
            'discount' => 'Discount',
            'purposeId' => 'Purpose ID',
            'idPresented' => 'Id Presented',
            'validity' => 'Validity',
            'idNumber' => 'Id Number',
            'orId' => 'Or ID',
            'total' => 'Total',
            'reportDue' => 'Report Due',
            'conforme' => 'Conforme',
            'conformeGender' => 'Conforme Gender',
            'receivedBy' => 'Received By',
            'mode_release' => 'Mode Release',
            'modeofreleaseId' => 'Modeofrelease ID',
            'returnSample' => 'Return Sample',
            'return_samples' => 'Return Samples',
            'notes' => 'Notes',
            'cancelled' => 'Cancelled',
            'reported' => 'Reported',
            'analysts' => 'Analysts',
            'remarks' => 'Remarks',
            'remark' => 'Remark',
            'additionalAddress' => 'Additional Address',
            'man_hour' => 'Man Hour',
            'determination' => 'Determination',
            'released' => 'Released',
            'create_time' => 'Create Time',
            'completed' => 'Completed',
            'otherrequestId' => 'Otherrequest ID',
        ];
    }
}
