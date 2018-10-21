<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tr08nhr */

$this->title = $model->idn_08in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nombre herramientas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr08nhr-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->idn_08in], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->idn_08in], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Esta seguro que desea eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idn_08in',
            'nom_08vc',
            'ima_08vc',
        ],
    ]) ?>

</div>
