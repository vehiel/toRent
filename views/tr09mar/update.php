<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr09mar */

$this->title = Yii::t('app', 'Update Tr09mar: ' . $model->cgm_09in, [
    'nameAttribute' => '' . $model->cgm_09in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr09mars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cgm_09in, 'url' => ['view', 'id' => $model->cgm_09in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr09mar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
