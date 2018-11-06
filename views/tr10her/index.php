<?php

use app\models\Tr09mar;
use app\models\Tr08nhr;
use yii\helpers\Html;
use yii\grid\GridView;
use \nterms\pagesize\PageSize;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr10herSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Herramientas');
$this->params['breadcrumbs'][] = $this->title;
AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);
?>
<div class="tr10her-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Herramienta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'chr_10in',

            [
              'attribute'=>'tr08nhr.nom_08vc',
              'label'=>Yii::t('app','Nombre herramienta'),
              'value'=> function($model){
                $nombre = Tr08nhr::findOne($model->idn_08in);
                if(@$nombre){
                  return $nombre->nom_08vc;
                }else{
                  return "No Definido";
                }
              }
            ],
            [
              'attribute'=>'tr09mar.nom_09vc',
              'label'=>Yii::t('app','Marca'),
              'value'=> function($model){
                $marca = Tr09mar::findOne($model->cgm_09in);
                if(@$marca){
                  return $marca->nom_09vc;
                }else{
                  return "No Definido";
                }
              }
            ],
            [
              'attribute'=>'vol_10in',
              'filter'=>Html::activeDropDownList($searchModel, 'vol_10in',
              ['1'=>'110','2'=>'220','3'=>'No Aplica'],['class' => 'form-control','prompt' => 'Todos']),
              'value'=> function($model){
                if ($model->vol_10in == 1){
                  return "110";
                }elseif ($model->vol_10in == 2) {
                  return "220";
                }else{
                  return "No aplica";
                }
              }
            ],
            'des_10vc',
            [
              'attribute'=>'est_10in',
              'filter'=>Html::activeDropDownList($searchModel, 'est_10in',
              ['1'=>'Activo','0'=>'Inactivo'],['class' => 'form-control','prompt' => 'Todos']),
              'value'=>  function($model){
                if($model->est_10in == 1){
                  return "Activo";
                }else{
                  return "Inactivo";
                }
              }
            ],
            [
              'attribute'=>'pre_10de',
              'value'=>function($model){
                return number_format($model->pre_10de,2,'.',',');
              }
            ],
            'can_10in',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
