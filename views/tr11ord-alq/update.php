<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr11ordAlq */

$this->title = Yii::t('app', 'Update Tr11ord Alq: ' . $model->ido_11in, [
    'nameAttribute' => '' . $model->ido_11in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr11ord Alqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ido_11in, 'url' => ['view', 'id' => $model->ido_11in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr11ord-alq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
