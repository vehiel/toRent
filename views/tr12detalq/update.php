<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tr12detalq */

$this->title = Yii::t('app', 'Update Tr12detalq: ' . $model->idd_12in, [
    'nameAttribute' => '' . $model->idd_12in,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr12detalqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idd_12in, 'url' => ['view', 'id' => $model->idd_12in]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr12detalq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
