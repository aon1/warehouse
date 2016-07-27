<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Imei;

/**
 * ImeiSearch represents the model behind the search form about `common\models\Imei`.
 */
class ImeiSearch extends Imei
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imei_id', 'warehouse_current', 'warehouse_destiny', 'master_id', 'pallet_id', 'status_id', 'product_id'], 'integer'],
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
        $query = Imei::find();

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
            'imei_id' => $this->imei_id,
            'warehouse_current' => $this->warehouse_current,
            'warehouse_destiny' => $this->warehouse_destiny,
            'master_id' => $this->master_id,
            'pallet_id' => $this->pallet_id,
            'status_id' => $this->status_id,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
