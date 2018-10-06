<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr09mar */

$this->title = $model->cgm_09in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr09mars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr09mar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->cgm_09in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->cgm_09in], [
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
            'cgm_09in',
            'nom_09vc',
            'est_09in',
        ],
    ]) ?>

</div>
