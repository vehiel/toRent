<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr09mar */

$this->title = $model->cgm_09in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr09mar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->cgm_09in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->cgm_09in], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Esta seguro que desea eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cgm_09in',
            'nom_09vc',
            [
              'attribute'=>'est_09in',
              'value'=>function($model){
                if($model->est_09in == 1){
                  return "Activo";
                }elseif($model->est_09in == 0){
                  return "Inactivo";
                }else{
                  return "No definido";
                }
              }
            ],
        ],
    ]) ?>

</div>
