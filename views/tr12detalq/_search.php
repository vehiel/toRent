<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Tr12detalqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr12detalq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idd_12in') ?>

    <?= $form->field($model, 'ido_11in') ?>

    <?= $form->field($model, 'chr_10in') ?>

    <?= $form->field($model, 'pre_12de') ?>

    <?= $form->field($model, 'can_12in') ?>

    <?php // echo $form->field($model, 'mto_12de') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
