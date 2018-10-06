<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Tr06cliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr06cli-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idp_06in') ?>

    <?= $form->field($model, 'con_06vc') ?>

    <?= $form->field($model, 'ncl_06in') ?>

    <?= $form->field($model, 'emo_06in') ?>

    <?= $form->field($model, 'obs_06vc') ?>

    <?php // echo $form->field($model, 'nom_06vc') ?>

    <?php // echo $form->field($model, 'ap1_06vc') ?>

    <?php // echo $form->field($model, 'ap2_06vc') ?>

    <?php // echo $form->field($model, 'tel_06vc') ?>

    <?php // echo $form->field($model, 'gen_06in') ?>

    <?php // echo $form->field($model, 'ema_06vc') ?>

    <?php // echo $form->field($model, 'dir_06vc') ?>

    <?php // echo $form->field($model, 'ncu_06vc') ?>

    <?php // echo $form->field($model, 'fna_06dt') ?>

    <?php // echo $form->field($model, 'nac_06vc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
