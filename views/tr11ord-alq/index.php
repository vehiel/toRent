<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr11ordAlqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tr11ord Alqs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr11ord-alq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tr11ord Alq'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ido_11in',
            'ncl_06in',
            'fso_11dt',
            'fre_11dt',
            'fde_11dt',
            //'sto_11de',
            //'mto_11de',
            //'est_11in',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
