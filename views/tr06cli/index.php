<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr06cliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr06cli-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Cliente'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idp_06in',
            //'emo_06in',
            //'obs_06vc',
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
            'ema_06vc:email',
            //'dir_06vc',
            //'ncu_06vc',
            //'fna_06dt',
            //'nac_06vc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
