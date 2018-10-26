<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr11ordAlq */

$this->title = $model->ido_11in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr11ord Alqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr11ord-alq-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ido_11in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ido_11in], [
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
            'ido_11in',
            'ncl_06in',
            'fso_11dt',
            'fre_11dt',
            'fde_11dt',
            'sto_11de',
            'mto_11de',
            'est_11in',
        ],
    ]) ?>

</div>
