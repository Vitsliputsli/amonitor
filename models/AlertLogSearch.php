<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AlertLog;

/**
 * AlertLogSearch represents the model behind the search form about `app\models\AlertLog`.
 */
class AlertLogSearch extends AlertLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monitor_items_id'], 'integer'],
            [['time', 'status', 'item_value', 'email_send'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = AlertLog::find();

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
            'monitor_items_id' => $this->monitor_items_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'item_value', $this->item_value])
            ->andFilterWhere(['like', 'email', $this->email_send]);

        $query->orderBy(['time'=>SORT_DESC]);

        return $dataProvider;
    }
}
