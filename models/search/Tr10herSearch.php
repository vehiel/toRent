<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tr10her;

/**
 * Tr10herSearch represents the model behind the search form of `app\models\Tr10her`.
 */
class Tr10herSearch extends Tr10her
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chr_10in', 'vol_10in', 'vut_10in', 'gar_10in', 'tip_10in', 'est_10in', 'alq_10in','can_10in'], 'integer'],
            [['des_10vc', 'ser_10vc'], 'safe'],
            ['pre_10de','number'],
            [['tr08nhr.nom_08vc','tr09mar.nom_09vc'],'safe']
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
        $query = Tr10her::find();

        // add conditions that should always apply here
        $query->leftJoin(
          [
            'tr08nhr'//tabla con la que va a hacer el join
          ],
          'tr08nhr.idn_08in = tr10her.idn_08in'
        );
        $query->leftJoin(
          [
            'tr09mar'//tabla con la que va a hacer el join
          ],
          'tr09mar.cgm_09in = tr10her.cgm_09in'
        );

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
            'chr_10in' => $this->chr_10in,
            'idn_08in' => $this->idn_08in,
            'cgm_09in' => $this->cgm_09in,
            'vol_10in' => $this->vol_10in,
            'vut_10in' => $this->vut_10in,
            'gar_10in' => $this->gar_10in,
            'tip_10in' => $this->tip_10in,
            'est_10in' => $this->est_10in,
            'alq_10in' => $this->alq_10in,
            'can_10in' => $this->can_10in,
        ]);

        $query->andFilterWhere(['like', 'des_10vc', $this->des_10vc])
            ->andFilterWhere(['like', 'ser_10vc', $this->ser_10vc])
            ->andFilterWhere(['like', 'pre_10de', $this->pre_10de])
            ->andFilterWhere(['like', 'tr08nhr.nom_08vc',
            $this->getAttribute('tr08nhr.nom_08vc')])
            ->andFilterWhere(['like', 'tr09mar.nom_09vc',
            $this->getAttribute('tr09mar.nom_09vc')]);

        return $dataProvider;
    }
}
