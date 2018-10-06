<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */

$this->title = $model->chr_10in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr10hers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr10her-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->chr_10in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->chr_10in], [
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
            'idn_08in',
            'cgm_09in',
            'vol_10in',
            'des_10vc',
            'vut_10in',
            'gar_10in',
            'tip_10in',
            'est_10in',
            'alq_10in',
        ],
    ]) ?>

</div>
