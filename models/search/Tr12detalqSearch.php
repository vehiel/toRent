<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr12detalq;

/**
 * Tr12detalqSearch represents the model behind the search form of `app\models\Tr12detalq`.
 */
class Tr12detalqSearch extends Tr12detalq
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idd_12in', 'ido_11in', 'chr_10in', 'can_12in'], 'integer'],
            [['pre_12de', 'mto_12de'], 'number'],
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
        $query = Tr12detalq::find();

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
            'idd_12in' => $this->idd_12in,
            'ido_11in' => $this->ido_11in,
            'chr_10in' => $this->chr_10in,
            'pre_12de' => $this->pre_12de,
            'can_12in' => $this->can_12in,
            'mto_12de' => $this->mto_12de,
        ]);

        return $dataProvider;
    }
}
