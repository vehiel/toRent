<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\daterange\DateRangePicker;
use app\models\Tr06cli;
use app\models\Tr11ordAlq;
use yii\helpers\ArrayHelper;

// use app\models\Tr10her;

// $query = new  \yii\db\Query;
//
// $query	->select([
//         'tr08nhr.nom_08vc',
//         'tr10her.pre_10de',
//         'tr10her.ima_10vc'
//       ])
//       ->from('tr08nhr')
//       ->join('INNER JOIN', 'tr10her','tr08nhr.idn_08in = tr10her.idn_08in');
//       $command = $query->createCommand();
//       $data = $command->queryAll();
//       var_dump($data);

// use app\models\Tr08nhr;
// $var = Tr08nhr::find()->select(['nom_08vc', 'h.pre_10de', 'h.ima_10vc'])
// ->innerJoin(['h'=>'tr10her'],'tr08nhr.idn_08in = h.idn_08in')->asArray()->all();
//   foreach ($var as $key) {
//     echo $key['nom_08vc'];
//     echo "<br />";
//     echo $key['pre_10de'];
//     echo "<br />";
//     echo $key['ima_10vc'];
//     echo "<br />";
//   }

// echo json_encode($var);
// var_dump($var);


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr11ordAlqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ordenes');
$this->params['breadcrumbs'][] = $this->title;

AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);

?>
<div class="tr12detalq-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a(Yii::t('app', 'Crear Orden'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      'ido_11in',
      [
        'attribute'=>'tr06cli.nom_06vc',
        'label'=>Yii::t('app','Cliente'),
        'value'=> function($model){
          $cl = Tr06cli::findOne(['ncl_06in'=>$model->ncl_06in]);
          if(@$cl){
            return $cl['nom_06vc'].' '.$cl['ap1_06vc'].' '.$cl['ap2_06vc'];
          }
        }
      ],
      // 'fso_11dt',
      /*
      muestra la fecha del movimiento y pone un filtro con rango de fechas */
      [
        'attribute'=>'fso_11dt',
        // here we render the widget
        'filter' => DateRangePicker::widget([
          'model' => $searchModel,
          /*se pone el attribute que esta en el modelo, para que a la hora de cargar o filtrar el DatePicker no de error -> invalid date*/
          'attribute' => 'fso_11dt',
          'name'=>'fso_11dt',
          /*si no se pone esta line entonces la fso_11dt es erronea 2018-59-3*/
          'convertFormat' => true,
          'pluginOptions' => [
            'allowClear' => true,
            /*el DatePicker se abre hacia la izquierda, para no haya problema con el borde de la pantalla*/
            'opens'=>'left',
            'locale' => [
              'format' => 'Y-m-d'
            ],
          ],
          'language' => 'es',
          // 'pluginEvents'=>[
          //   'cancel.daterangepicker'=>"function(ev, picker) {\$('#daterangeinput').val(''); // clear any inputs};"
          // ],
          /*muestra la lista de opciones predeterminadas*/
          'presetDropdown'=>true,
          /*evita que se pueda ingresar texto directamente en el input*/
          'hideInput'=>true
        ]),
        'value'=>function($model){
          $hora = date('H', strtotime($model->fso_11dt));
          $model->fso_11dt = date('d-m-Y h:i:s', strtotime($model->fso_11dt));
          if($hora > 12){
            return $model->fso_11dt." PM";
          }else{
            return $model->fso_11dt." AM";
          }
        }
      ],
      [
        'attribute'=>'mto_11de',
        'value'=>function($model11){
          return number_format($model11->mto_11de,2,'.',',');
        }
      ],
      [
        'attribute'=>'est_11in',
        'filter'=>Html::activeDropDownList($searchModel, 'est_11in',
        ['1'=>'Activo','2'=>'Solicitado','3'=>'Retirado','0'=>'Inactivo','4'=>'Vencido','5'=>'Devuelto'],
        ['class' => 'form-control','prompt' => 'Todos']),
        'value'=>function($mode11){
          switch ($mode11->est_11in) {
            case 0:
            return "Inactivo";
              break;
            case 1:
            return "Activo";
            break;
            case 2:
            return "Solicitado";
            break;
            case 3:
            return "Retirado";
            break;
            case 4:
            return "Vencido";
            break;
            case 5:
            return "Devuelto";
            break;
          }
        }
      ],
      /*'idd_12in',
      'ido_11in',
      'chr_10in',
      'pre_12de',
      'can_12in',*/
      //'mto_12de',

      ['class' => 'yii\grid\ActionColumn'],
    ],
  ]); ?>
</div>
