<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model11 app\models\Tr12detalq */

$this->title = Yii::t('app', 'Actualizar Orden: ' . $model11->ido_11in, [
    'nameAttribute' => '' . $model11->ido_11in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ordenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model11->ido_11in, 'url' => ['view', 'id' => $model11->ido_11in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr12detalq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model11' => $model11,
        'model12' => $model12,
    ]) ?>

</div>
