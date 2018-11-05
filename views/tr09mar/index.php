<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \nterms\pagesize\PageSize;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr09marSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Marcas');
$this->params['breadcrumbs'][] = $this->title;
AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);
?>
<div class="tr09mar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Marca'), ['create'], ['class' => 'btn btn-success']) ?>
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

            'cgm_09in',
            'nom_09vc',
            [
              'attribute'=>'est_09in',
              'filter'=>Html::activeDropDownList($searchModel, 'est_09in',
              ['1'=>'Activo','0'=>'Inactivo'],['class' => 'form-control','prompt' => 'Todos']),
              'value'=>  function($model){
                if($model->est_09in == 1){
                  return "Activo";
                }else{
                  return "Inactivo";
                }
              }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
