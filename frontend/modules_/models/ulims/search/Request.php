<?php

namespace frontend\modules\models\ulims\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\ulims\Request as RequestModel;
use frontend\modules\models\accounting\OopDetails;

/**
 * Request represents the model behind the search form of `frontend\modules\models\Request`.
 */
class Request extends RequestModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rstl_id', 'labId', 'sublabId', 'customerId', 'paymentType', 'discount', 'purposeId', 'orId', 'mode_release', 'returnSample', 'return_samples', 'cancelled', 'determination', 'completed'], 'integer'],
            [['requestRefNum', 'requestId', 'requestDate', 'requestTime', 'idPresented', 'validity', 'idNumber', 'reportDue', 'conforme', 'conformeGender', 'receivedBy', 'modeofreleaseId', 'notes', 'reported', 'analysts', 'remarks', 'remark', 'additionalAddress', 'man_hour', 'released', 'create_time', 'otherrequestId'], 'safe'],
            [['total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RequestModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'requestDate' => $this->requestDate,
            'rstl_id' => $this->rstl_id,
            'labId' => $this->labId,
            'sublabId' => $this->sublabId,
            'customerId' => $this->customerId,
            'paymentType' => $this->paymentType,
            'discount' => $this->discount,
            'purposeId' => $this->purposeId,
            'orId' => $this->orId,
            'total' => $this->total,
            'reportDue' => $this->reportDue,
            'mode_release' => $this->mode_release,
            'returnSample' => $this->returnSample,
            'return_samples' => $this->return_samples,
            'cancelled' => $this->cancelled,
            'reported' => $this->reported,
            'determination' => $this->determination,
            'released' => $this->released,
            'create_time' => $this->create_time,
            'completed' => $this->completed,
        ]);

        $query->andFilterWhere(['like', 'requestRefNum', $this->requestRefNum])
            ->andFilterWhere(['like', 'requestId', $this->requestId])
            ->andFilterWhere(['like', 'requestTime', $this->requestTime])
            ->andFilterWhere(['like', 'idPresented', $this->idPresented])
            ->andFilterWhere(['like', 'validity', $this->validity])
            ->andFilterWhere(['like', 'idNumber', $this->idNumber])
            ->andFilterWhere(['like', 'conforme', $this->conforme])
            ->andFilterWhere(['like', 'conformeGender', $this->conformeGender])
            ->andFilterWhere(['like', 'receivedBy', $this->receivedBy])
            ->andFilterWhere(['like', 'modeofreleaseId', $this->modeofreleaseId])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'analysts', $this->analysts])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'additionalAddress', $this->additionalAddress])
            ->andFilterWhere(['like', 'man_hour', $this->man_hour])
            ->andFilterWhere(['like', 'otherrequestId', $this->otherrequestId]);

        return $dataProvider;
    }
    
    public function searchRequestByCustomerId($id)
    {
        $query = RequestModel::find();
        
        $req = OopDetails::find();
        $list = $req->select('request_id')->all();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $query->where([
            'customerId' => $id,
            'cancelled' => 0,
        ]);
        foreach($list as $value){
            $query->andWhere(['not in', 'id', $value]);
        }
        
        $query->andWhere(['BETWEEN', 'requestDate', '2020-01-01', date('Y-m-d')]);
        
        return $dataProvider;
    }
    
    //get all records by Id
    public function getRequestById(array $reqId)
    {
        $query = RequestModel::find();
        
        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);*/
        
        $query->where(['in', 'id', $reqId]);
        
        //return $dataProvider;
        return $query->all();
    }
    
    public function getDetailsById($id)
    {
        $query = RequestModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
}
