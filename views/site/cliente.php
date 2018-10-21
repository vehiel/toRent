<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Clientes';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-clientes">
    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Clientes page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code> -->

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->nom_08vc), ['view', 'name' => $model->nom_08vc]);
        },
    ]) ?>

</div>
