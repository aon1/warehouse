<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WarehouseLimits;

/**
 * WarehouseLimitsSearch represents the model behind the search form about `common\models\WarehouseLimits`.
 */
class WarehouseLimitsSearch extends WarehouseLimits
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_limits_id', 'warehouse_origin_id', 'warehouse_target_id'], 'integer'],
            [['limit_1'], 'number'],
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
        $query = WarehouseLimits::find();

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
            'warehouse_limits_id' => $this->warehouse_limits_id,
            'warehouse_origin_id' => $this->warehouse_origin_id,
            'warehouse_target_id' => $this->warehouse_target_id,
            'limit_1' => $this->limit_1,
        ]);

        return $dataProvider;
    }
}
