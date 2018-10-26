<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr12detalq */

$this->title = $model->idd_12in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr12detalqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr12detalq-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idd_12in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idd_12in], [
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
            'idd_12in',
            'ido_11in',
            'chr_10in',
            'pre_12de',
            'can_12in',
            'mto_12de',
        ],
    ]) ?>

</div>
