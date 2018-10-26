<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr11ordAlq;

/**
 * Tr11ordAlqSearch represents the model behind the search form of `app\models\Tr11ordAlq`.
 */
class Tr11ordAlqSearch extends Tr11ordAlq
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ido_11in', 'ncl_06in', 'est_11in'], 'integer'],
            [['fso_11dt', 'fre_11dt', 'fde_11dt'], 'safe'],
            [['sto_11de', 'mto_11de'], 'number'],
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
        $query = Tr11ordAlq::find();

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
            'ido_11in' => $this->ido_11in,
            'ncl_06in' => $this->ncl_06in,
            'fso_11dt' => $this->fso_11dt,
            'fre_11dt' => $this->fre_11dt,
            'fde_11dt' => $this->fde_11dt,
            'sto_11de' => $this->sto_11de,
            'mto_11de' => $this->mto_11de,
            'est_11in' => $this->est_11in,
        ]);

        return $dataProvider;
    }
}
