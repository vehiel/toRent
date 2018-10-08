<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */

$this->title = Yii::t('app', 'Actualizar herramienta: ' . $model->chr_10in, [
    'nameAttribute' => '' . $model->chr_10in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Herramientas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->chr_10in, 'url' => ['view', 'id' => $model->chr_10in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="tr10her-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
