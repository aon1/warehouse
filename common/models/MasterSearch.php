<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Master;

/**
 * MasterSearch represents the model behind the search form about `common\models\Master`.
 */
class MasterSearch extends Master
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_id', 'warehouse_current', 'warehouse_destiny', 'pallet_id', 'status_id'], 'integer'],
            [['code'], 'safe'],
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
        $query = Master::find();

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
            'master_id' => $this->master_id,
            'warehouse_current' => $this->warehouse_current,
            'warehouse_destiny' => $this->warehouse_destiny,
            'pallet_id' => $this->pallet_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
