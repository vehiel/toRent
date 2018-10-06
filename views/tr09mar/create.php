<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tr09mar */

$this->title = Yii::t('app', 'Create Tr09mar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr09mars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr09mar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
