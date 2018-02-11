<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AlertEmails;

/**
 * AlertEmailsSearch represents the model behind the search form about `app\models\AlertEmails`.
 */
class AlertEmailsSearch extends AlertEmails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monitor_groups_id'], 'integer'],
            [['monitor_items_id','email'], 'safe'],
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
        $query = AlertEmails::find();

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

        $query->joinWith('monitorItem');

        // grid filtering conditions
        $query->andFilterWhere([
            'monitor_groups_id' => $this->monitor_groups_id,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email]);

        $query->andFilterWhere(['like', MonitorItems::tableName().'.item_name', $this->monitor_items_id]);

        return $dataProvider;
    }
}
