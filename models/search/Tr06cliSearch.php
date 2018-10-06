<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr06cli;

/**
 * Tr06cliSearch represents the model behind the search form of `app\models\Tr06cli`.
 */
class Tr06cliSearch extends Tr06cli
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idp_06in', 'ncl_06in', 'emo_06in', 'gen_06in'], 'integer'],
            [['con_06vc', 'obs_06vc', 'nom_06vc', 'ap1_06vc', 'ap2_06vc', 'tel_06vc', 'ema_06vc', 'dir_06vc', 'ncu_06vc', 'fna_06dt', 'nac_06vc'], 'safe'],
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
        $query = Tr06cli::find();

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
            'ncl_06in' => $this->ncl_06in,
            'emo_06in' => $this->emo_06in,
            'gen_06in' => $this->gen_06in,
            'fna_06dt' => $this->fna_06dt,
        ]);

        $query->andFilterWhere(['like', 'con_06vc', $this->con_06vc])
            ->andFilterWhere(['like', 'obs_06vc', $this->obs_06vc])
            ->andFilterWhere(['like', 'nom_06vc', $this->nom_06vc])
            ->andFilterWhere(['like', 'ap1_06vc', $this->ap1_06vc])
            ->andFilterWhere(['like', 'ap2_06vc', $this->ap2_06vc])
            ->andFilterWhere(['like', 'tel_06vc', $this->tel_06vc])
            ->andFilterWhere(['like', 'ema_06vc', $this->ema_06vc])
            ->andFilterWhere(['like', 'dir_06vc', $this->dir_06vc])
            ->andFilterWhere(['like', 'ncu_06vc', $this->ncu_06vc])
            ->andFilterWhere(['like', 'nac_06vc', $this->nac_06vc])
            ->andFilterWhere(['like', 'idp_06in', $this->idp_06in]);

        return $dataProvider;
    }
}
