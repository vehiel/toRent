<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr02usu;

/**
 * Tr02usuSearch represents the model behind the search form of `app\models\Tr02usu`.
 */
class Tr02usuSearch extends Tr02usu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nus_02in', 'idp_02in', 'est_02in', 'idr_03in', 'gen_02in'], 'integer'],
            [['con_02vc', 'nom_02vc', 'ap1_02vc', 'ap2_02vc', 'tel_02vc', 'ema_02vc', 'dir_02vc', 'ncu_02vc', 'fna_02dt', 'nac_02vc'], 'safe'],
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
        $query = Tr02usu::find();

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
            'nus_02in' => $this->nus_02in,
            'est_02in' => $this->est_02in,
            'idr_03in' => $this->idr_03in,
            'gen_02in' => $this->gen_02in,
            'fna_02dt' => $this->fna_02dt,
        ]);

        $query->andFilterWhere(['like', 'con_02vc', $this->con_02vc])
            ->andFilterWhere(['like', 'nom_02vc', $this->nom_02vc])
            ->andFilterWhere(['like', 'ap1_02vc', $this->ap1_02vc])
            ->andFilterWhere(['like', 'ap2_02vc', $this->ap2_02vc])
            ->andFilterWhere(['like', 'tel_02vc', $this->tel_02vc])
            ->andFilterWhere(['like', 'ema_02vc', $this->ema_02vc])
            ->andFilterWhere(['like', 'dir_02vc', $this->dir_02vc])
            ->andFilterWhere(['like', 'ncu_02vc', $this->ncu_02vc])
            ->andFilterWhere(['like', 'nac_02vc', $this->nac_02vc])
            ->andFilterWhere(['like', 'idp_02in', $this->idp_02in]);

        return $dataProvider;
    }
}
