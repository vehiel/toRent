<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \nterms\pagesize\PageSize;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr06cliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientes');
$this->params['breadcrumbs'][] = $this->title;
AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);
?>
<div class="tr06cli-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Cliente'), ['create'], ['class' => 'btn btn-success']) ?>
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
        /*se aplica el filtro a la tabla*/
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ncl_06in',
            'idp_06in',
            //'emo_06in',
            //'obs_06vc',
            'nom_06vc',
            'ap1_06vc',
            'ap2_06vc',
            'tel_06vc',
            [
              'attribute'=>'gen_06in',
              'filter'=>Html::activeDropDownList($searchModel, 'gen_06in',
              ['1'=>'Masculino','0'=>'Femenino'],['class' => 'form-control','prompt' => 'Todos']),
              'value'=>function($model){
                if($model->gen_06in == 1){
                  return "Masculino";
                }else{
                  return "Femenino";
                }
              }
            ],
            'ema_06vc:email',
            //'dir_06vc',
            //'ncu_06vc',
            //'fna_06dt',
            //'nac_06vc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
