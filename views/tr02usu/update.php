<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr02usu */

$this->title = Yii::t('app', 'Actualizar Usuario: ' . $model->idp_02in, [
    'nameAttribute' => '' . $model->idp_02in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idp_02in, 'url' => ['view', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr02usu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
