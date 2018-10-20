<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tr08nhr */

$this->title = Yii::t('app', 'Crear Nombre Herramienta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nombre Herramienta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr08nhr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
