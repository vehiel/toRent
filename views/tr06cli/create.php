<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tr06cli */

$this->title = Yii::t('app', 'Crear Cliente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr06cli-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
