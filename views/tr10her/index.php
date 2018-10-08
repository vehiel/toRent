<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr10herSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Herramientas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr10her-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Herramienta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'chr_10in',
            'idn_08in',
            'cgm_09in',
            'vol_10in',
            'des_10vc',
            //'vut_10in',
            //'gar_10in',
            //'tip_10in',
            'est_10in',
            //'alq_10in',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
