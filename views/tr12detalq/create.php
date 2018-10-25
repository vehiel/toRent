<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model12 app\models\Tr12detalq */

$this->title = Yii::t('app', 'Crear Orden');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr12detalqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr12detalq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model12' => $model12,
        'model11' => $model11,
    ]) ?>

</div>
