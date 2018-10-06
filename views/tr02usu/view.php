<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr02usu */

$this->title = $model->idp_02in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuario'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr02usu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in], [
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
            'nus_02in',
            'idp_02in',
            //'con_02vc',
            'nom_02vc',
            'ap1_02vc',
            'ap2_02vc',
            'tel_02vc',
            [
              'attribute'=>'gen_02in',
              'value'=>function($model){
                if($model->gen_02in == 1){
                  return "Masculino";
                }elseif($model->gen_02in == 0){
                  return "Femenino";
                }else{
                  return "No definido";
                }
              }
            ],
            'ema_02vc',
            'dir_02vc',
            'ncu_02vc',
            'fna_02dt',
            'nac_02vc',
            [
              'attribute'=>'est_02in',
              'value'=>function($model){
                if($model->est_02in == 1){
                  return "Activo";
                }elseif($model->est_02in == 0){
                  return "Inactivo";
                }else{
                  return "No definido";
                }
              }
            ],
        ],
    ]) ?>

</div>
