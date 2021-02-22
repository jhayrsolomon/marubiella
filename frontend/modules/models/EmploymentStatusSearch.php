<?php

namespace frontend\modules\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\EmploymentStatus;

/**
 * EmploymentStatusSearch represents the model behind the search form of `frontend\modules\models\EmploymentStatus`.
 */
class EmploymentStatusSearch extends EmploymentStatus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['employment_status_code', 'employment_status_description', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
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
        $query = EmploymentStatus::find();

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
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'employment_status_code', $this->employment_status_code])
            ->andFilterWhere(['like', 'employment_status_description', $this->employment_status_description]);

        return $dataProvider;
    }
}
