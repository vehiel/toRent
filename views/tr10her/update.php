<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */

$this->title = Yii::t('app', 'Update Tr10her: ' . $model->chr_10in, [
    'nameAttribute' => '' . $model->chr_10in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr10hers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->chr_10in, 'url' => ['view', 'id' => $model->chr_10in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr10her-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
