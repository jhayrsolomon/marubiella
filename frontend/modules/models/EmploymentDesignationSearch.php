<?php

namespace frontend\modules\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\EmploymentDesignation;

/**
 * EmploymentDesignationSearch represents the model behind the search form of `frontend\modules\models\EmploymentDesignation`.
 */
class EmploymentDesignationSearch extends EmploymentDesignation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['employment_designation_code', 'employment_designation_code_description', 'employment_designation_job_description', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
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
        $query = EmploymentDesignation::find();

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

        $query->andFilterWhere(['like', 'employment_designation_code', $this->employment_designation_code])
            ->andFilterWhere(['like', 'employment_designation_code_description', $this->employment_designation_code_description])
            ->andFilterWhere(['like', 'employment_designation_job_description', $this->employment_designation_job_description]);

        return $dataProvider;
    }
}
