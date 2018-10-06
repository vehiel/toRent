<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr02usu */

$this->title = Yii::t('app', 'Update Tr02usu: ' . $model->nus_02in, [
    'nameAttribute' => '' . $model->nus_02in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr02usus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nus_02in, 'url' => ['view', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr02usu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
