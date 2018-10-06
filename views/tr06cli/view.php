<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr06cli */

$this->title = $model->idp_06in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr06cli-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'idp_06in' => $model->idp_06in, 'ncl_06in' => $model->ncl_06in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'idp_06in' => $model->idp_06in, 'ncl_06in' => $model->ncl_06in], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Desea eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idp_06in',
            //'con_06vc',
            'ncl_06in',
            'nom_06vc',
            'ap1_06vc',
            'ap2_06vc',
            'tel_06vc',
            [
              'attribute'=>'gen_06in',
              'value'=>function($model){
                if($model->gen_06in == 1){
                  return "Masculino";
                }else{
                  return "Femenino";
                }
              }
            ],
            'ema_06vc',
            'dir_06vc',
            'ncu_06vc',
            'fna_06dt',
            'nac_06vc',
            [
              'attribute'=>'emo_06in',
              'value'=>function($model){
                if($model->emo_06in == 1){
                  return "Moroso";
                }else{
                  return "Limpio";
                }
              }
            ],
            'obs_06vc',
        ],
    ]) ?>

</div>
