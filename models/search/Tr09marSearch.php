<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr09mar;

/**
 * Tr09marSearch represents the model behind the search form of `app\models\Tr09mar`.
 */
class Tr09marSearch extends Tr09mar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cgm_09in', 'est_09in'], 'integer'],
            [['nom_09vc'], 'safe'],
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
        $query = Tr09mar::find();

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
            'cgm_09in' => $this->cgm_09in,
            'est_09in' => $this->est_09in,
        ]);

        $query->andFilterWhere(['like', 'nom_09vc', $this->nom_09vc]);

        return $dataProvider;
    }
}
