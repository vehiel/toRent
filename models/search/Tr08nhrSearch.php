<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr08nhr;

/**
 * Tr08nhrSearch represents the model behind the search form of `app\models\Tr08nhr`.
 */
class Tr08nhrSearch extends Tr08nhr
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idn_08in'], 'integer'],
            [['nom_08vc'], 'safe'],
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
        $query = Tr08nhr::find();

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
            'idn_08in' => $this->idn_08in,
        ]);

        $query->andFilterWhere(['like', 'nom_08vc', $this->nom_08vc]);

        return $dataProvider;
    }
}
