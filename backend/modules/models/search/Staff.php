<?php

namespace backend\modules\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\models\Staff as StaffModel;

/**
 * Staff represents the model behind the search form of `backend\modules\models\Staff`.
 */
class Staff extends StaffModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'position_id', 'div_id', 'status_id'], 'integer'],
            [['fname', 'mname', 'lname', 'contact', 'email', 'created_date'], 'safe'],
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
        $query = StaffModel::find();

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
            'position_id' => $this->position_id,
            'div_id' => $this->div_id,
            'status_id' => $this->status_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mname', $this->mname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
