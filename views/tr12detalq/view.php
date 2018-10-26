<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model11 app\models\Tr12detalq */
/* @var $searchModel app\models\search\Tr12detalqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Orden: ').$model11->ido_11in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ordenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr12detalq-view">



  <p>
    <?php // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model11->ido_11in], ['class' => 'btn btn-primary']) ?>
    <?php /* Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model11->ido_11in], [
      'class' => 'btn btn-danger',
      'data' => [
      'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
      'method' => 'post',
    ],
    ]) */?>
  </p>
  <div class="panel panel-default">
    <div  class="panel-heading"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="panel-body ">
      <?= DetailView::widget([
        'model' => $model11,
        'attributes' => [
          'ido_11in',
          'ncl_06in',
          'fso_11dt',
          'fre_11dt',
          'fde_11dt',
          'mto_11de',
          'est_11in',
        ],
        ]) ?>
      </div>
    </div>

    <div class="panel panel-default">
      <div  class="panel-heading"><h1>Artículos</h1></div>
      <div class="panel-body ">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'idd_12in',
        'ido_11in',
        'chr_10in',
        'pre_12de',
        'can_12in',
        'mto_12de',

        ['class' => 'yii\grid\ActionColumn'],
      ],
    ]); ?>
  </div>
</div>

  </div>
