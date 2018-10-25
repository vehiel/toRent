<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Tr12detalqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tr12detalqs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr12detalq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tr12detalq'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            //'mto_12de',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
