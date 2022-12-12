<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evaluation;

/**
 * EvaluationSearch represents the model behind the search form of `app\models\Evaluation`.
 */
class EvaluationSearch extends Evaluation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kpi_id', 'worker_id', 'condition'], 'integer'],
            [['priority', 'result'], 'safe'],
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
        $query = Evaluation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $query->select(['worker_id'])->groupBy('worker_id');
        
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kpi_id' => $this->kpi_id,
            'worker_id' => $this->worker_id,
            'condition' => $this->condition,
        ]);

        $query->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }
}
