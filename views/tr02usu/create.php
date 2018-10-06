<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tr02usu */

$this->title = Yii::t('app', 'Crear Usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuario'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr02usu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
