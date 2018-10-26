<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tr09mar;
use app\models\Tr08nhr;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */

$this->title = $model->chr_10in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Herramientas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr10her-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->chr_10in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->chr_10in], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'chr_10in',
            [
              'attribute'=>'idn_08in',
              'value'=> function($model){
                $marca = Tr08nhr::findOne($model->idn_08in);
                return $marca->nom_08vc;
              }
            ],
            [
              'attribute'=>'cgm_09in',
              'value'=> function($model){
                $marca = Tr09mar::findOne($model->cgm_09in);
                return $marca->nom_09vc;
              }
            ],
            [
              'attribute'=>'vol_10in',
              'value'=> function($model){
                if($model->vol_10in == 1){
                  return "110";
                }elseif($model->vol_10in == 2){
                  return "220";
                }elseif($model->vol_10in == 3){
                  return "No aplica";
                }
              }
            ],
            'des_10vc',
            'vut_10in',
            'gar_10in',
            [
              'attribute'=>'tip_10in',
              'value'=> function($model){
                if($model->tip_10in == 1){
                  return "Alambrico";
                }else{
                  return "Inalambrico";
                }
              }
            ],
            [
              'attribute'=>'est_10in',
              'value'=> function($model){
                if($model->est_10in == 1){
                  return "Activo";
                }else{
                  return "Inactivo";
                }
              }
            ],
            [
              'attribute'=>'alq_10in',
              'value'=> function($model){
                if($model->alq_10in == 1){
                  return "Alquilada";
                }else{
                  return "Libre";
                }
              }
            ],
            'ser_10vc',
            'ima_10vc',
            'pre_10de',
            'can_10in',
        ],
    ]) ?>

</div>
