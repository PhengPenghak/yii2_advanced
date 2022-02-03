<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Poitem;

/**
 * PoitemSearch represents the model behind the search form of `backend\models\Poitem`.
 */
class PoitemSearch extends Poitem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'po-id'], 'integer'],
            [['po_item_no'], 'safe'],
            [['quantity'], 'number'],
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
        $query = Poitem::find();

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
            'quantity' => $this->quantity,
            'po-id' => $this->po-id,
        ]);

        $query->andFilterWhere(['like', 'po_item_no', $this->po_item_no]);

        return $dataProvider;
    }
}