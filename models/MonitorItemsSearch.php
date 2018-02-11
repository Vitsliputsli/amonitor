<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MonitorItems;

/**
 * MonitorItemsSearch represents the model behind the search form about `app\models\MonitorItems`.
 */
class MonitorItemsSearch extends MonitorItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monitor_groups_id'], 'integer'],
            [['item_name', 'warning_operator', 'warning_value', 'alert_operator', 'alert_value'
                , 'value', 'db_error', 'time'], 'safe'],
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
        $query = MonitorItems::find();

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
            'monitor_groups_id' => $this->monitor_groups_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'warning_operator', $this->warning_operator])
            ->andFilterWhere(['like', 'warning_value', $this->warning_value])
            ->andFilterWhere(['like', 'alert_operator', $this->alert_operator])
            ->andFilterWhere(['like', 'alert_value', $this->alert_value])
            ->andFilterWhere(['like', 'value', $this->value]);

        $query->orderBy(['monitor_groups_id'=>SORT_DESC,'item_name'=>SORT_ASC]);

        return $dataProvider;
    }
}
