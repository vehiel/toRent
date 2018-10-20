<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr08nhr */

$this->title = Yii::t('app', 'Actualizar Nombre Herramienta: ' . $model->idn_08in, [
    'nameAttribute' => '' . $model->idn_08in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nombre herramienta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idn_08in, 'url' => ['view', 'id' => $model->idn_08in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr08nhr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
