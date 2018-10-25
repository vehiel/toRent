<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tr11ordAlq */

$this->title = Yii::t('app', 'Create Tr11ord Alq');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr11ord Alqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr11ord-alq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
