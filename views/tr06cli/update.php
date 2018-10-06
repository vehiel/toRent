<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr06cli */

$this->title = Yii::t('app', 'Actualizar Cliente: ' . $model->idp_06in, [
    'nameAttribute' => '' . $model->idp_06in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idp_06in, 'url' => ['view', 'idp_06in' => $model->idp_06in, 'ncl_06in' => $model->ncl_06in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="tr06cli-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
