<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;
use app\models\Tr06cli;
use app\models\Tr11ordAlq;
use yii\helpers\ArrayHelper;
use \nterms\pagesize\PageSize;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

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
<?php //foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
            <?php
            //  Growl::widget([
            //     'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
            //     'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
            //     'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            //     'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
            //     'showSeparator' => true,
            //     'delay' => 1, //This delay is how long before the message shows
            //     'pluginOptions' => [
            //         'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            //         'placement' => [
            //             'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
            //             'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            //         ]
            //     ]
            // ]);
            ?>
        <?php// endforeach; ?>
<div class="tr12detalq-index">
  <div class="alert alert-danger">
    <h4>Recuerde que las ordenes solicitadas tienen articulos <strong>bloqueados</strong>,
    se recomienda descartarlas para que los articulos esten disponibles.</h4>
  </div>
  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a(Yii::t('app', 'Crear Orden'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>
  <!-- <div class="alert alert-danger">
    <h4>Recuerde que las ordenes solicitadas tienen articulos bloqueados, se recomienda descartarlas para que los articulos esten disponibles.</h4>
  </div> -->
  <div align="right">
    <?php
    /*con esta vara pone la paginacion, pone como defualt 10 items, y las sizes son las diferentes cantidades disponibles a mostrar*/
    echo PageSize::widget(['defaultPageSize'=>10,
    'label'=>Yii::t('app','Elementos'),'sizes'=>['2'=>2,'5'=>5,'10'=>10,'15'=>15,'20'=>20,'50'=>50],
    'options' => ['class' => 'btn btn-default',
    'title' => Yii::t('app','Cantidad de elementos por página')]]); ?>
  </div>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    /*se aplica el filtro a la tabla*/
    'filterSelector' => 'select[name="per-page"]',
    'rowOptions'=>function($model){
      switch ($model->est_11in) {
        // case 0:
        // return "Inactivo";
        // break;
        case 1:
         return ['class'=>'success'];
        break;
        case 2:
        return ['class'=>'warning'];
        break;
        case 3:
         return ['class'=>'primary'];
        break;
        case 4:
         return ['class'=>'danger'];
        break;
        // case 5:
        // return "Devuelto";
        // break;
      }
    },
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
      /*
      muestra la fecha solicitud y pone un filtro con rango de fechas */
      [
        'attribute'=>'fcr_11dt',
        // here we render the widget
        'filter' => DateRangePicker::widget([
          'model' => $searchModel,
          /*se pone el attribute que esta en el modelo, para que a la hora de cargar o filtrar el DatePicker no de error -> invalid date*/
          'attribute' => 'fcr_11dt',
          'name'=>'fcr_11dt',
          /*si no se pone esta line entonces la fcr_11dt es erronea 2018-59-3*/
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
          if ($model->fcr_11dt !== null) {
            $hora = date('H', strtotime($model->fcr_11dt));
            $model->fcr_11dt = date('d-m-Y h:i:s', strtotime($model->fcr_11dt));
            if($hora > 12){
              return $model->fcr_11dt." PM";
            }else{
              return $model->fcr_11dt." AM";
            }
          }
        }
      ],
      /*
      muestra la fecha solicitud y pone un filtro con rango de fechas */
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
          if ($model->fso_11dt !== null) {
            $hora = date('H', strtotime($model->fso_11dt));
            $model->fso_11dt = date('d-m-Y h:i:s', strtotime($model->fso_11dt));
            if($hora > 12){
              return $model->fso_11dt." PM";
            }else{
              return $model->fso_11dt." AM";
            }
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
             // return ' &nbsp;&nbsp;&nbsp;<span class="label label-danger" style="font-size:12pt;">Alto</span>';
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
