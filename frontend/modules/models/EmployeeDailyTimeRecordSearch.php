<?php

namespace frontend\modules\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\EmployeeDailyTimeRecord;

/**
 * EmployeeDailyTimeRecordSearch represents the model behind the search form of `frontend\modules\models\EmployeeDailyTimeRecord`.
 */
class EmployeeDailyTimeRecordSearch extends EmployeeDailyTimeRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'employee_id'], 'integer'],
            [['today_date', 'in_out', 'time_report', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
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
        $query = EmployeeDailyTimeRecord::find();

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
            'user_id' => $this->user_id,
            'employee_id' => $this->employee_id,
            'today_date' => $this->today_date,
            'time_report' => $this->time_report,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'in_out', $this->in_out]);

        return $dataProvider;
    }
    
    public function searchTimeRecordByUserId()
    {
        $user_id = Yii::$app->user->identity->id;
        $query = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id])->all();
        return $query;
    }
}
