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
      [['tr06cli.nom_06vc'],'safe'],
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
    $query->leftJoin(
      [
        'tr06cli'//tabla con la que va a hacer el join
      ],
      'tr06cli.ncl_06in = tr11ord_alq.ncl_06in'
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
      'ido_11in' => $this->ido_11in,
      // 'ncl_06in' => $this->ncl_06in,
      // 'fso_11dt' => $this->fso_11dt,
      'fre_11dt' => $this->fre_11dt,
      'fde_11dt' => $this->fde_11dt,
      'sto_11de' => $this->sto_11de,
      'mto_11de' => $this->mto_11de,
      'est_11in' => $this->est_11in,
    ]);

    $query->orFilterWhere(['like', 'tr06cli.nom_06vc',
    $this->getAttribute('tr06cli.nom_06vc')])
    
    ->orFilterWhere(['like', 'tr06cli.ap1_06vc',
    $this->getAttribute('tr06cli.nom_06vc')])

    ->orFilterWhere(['like', 'tr06cli.ap2_06vc',
    $this->getAttribute('tr06cli.nom_06vc')]);

    /*vehiel 24/10/2018
    si se tiene un valor y esta separado por un - */
    if(!empty($this->fso_11dt) && strpos($this->fso_11dt, '-') !== false) {
      /*se hace un explode que es similar a un split y
      obtenemos ambas fechas separadas en variables*/
      list($start_date, $end_date) = explode(' - ', $this->fso_11dt);
      /*le decimos que tambien filtre entre el rango de fechas obtenidas
      como el campo en la base de datos es de tipo DateTime entonces debemos
      espeficicar la hora, de lo contrario buscara de las 00:00:00 a las 00:00:00
      2018-10-24 00:00:00 to 2018-10-24 00:00:00 y esto no devolvera nada*/
      /*select * from tbl_caja_chica_movimiento where fecha between '2018-10-23 00:00:00' and '2018-10-24 23:59:59';*/
      $query->andFilterWhere(['between', 'fso_11dt',
      $start_date.' 00:00:00', $end_date.' 23:59:59']);
    }

    return $dataProvider;
  }
}
