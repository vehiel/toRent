<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Tr10herSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr10her-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'chr_10in') ?>

    <?= $form->field($model, 'idn_08in') ?>

    <?= $form->field($model, 'cgm_09in') ?>

    <?= $form->field($model, 'vol_10in') ?>

    <?= $form->field($model, 'des_10vc') ?>

    <?php // echo $form->field($model, 'vut_10in') ?>

    <?php // echo $form->field($model, 'gar_10in') ?>

    <?php // echo $form->field($model, 'tip_10in') ?>

    <?php // echo $form->field($model, 'est_10in') ?>

    <?php // echo $form->field($model, 'alq_10in') ?>

    <?php // echo $form->field($model, 'ser_10vc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
