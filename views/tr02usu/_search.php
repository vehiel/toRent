<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Tr02usuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr02usu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nus_02in') ?>

    <?= $form->field($model, 'idp_02in') ?>

    <?= $form->field($model, 'con_02vc') ?>

    <?= $form->field($model, 'est_02in') ?>

    <?= $form->field($model, 'idr_03in') ?>

    <?php // echo $form->field($model, 'nom_02vc') ?>

    <?php // echo $form->field($model, 'ap1_02vc') ?>

    <?php // echo $form->field($model, 'ap2_02vc') ?>

    <?php // echo $form->field($model, 'tel_02vc') ?>

    <?php // echo $form->field($model, 'gen_02in') ?>

    <?php // echo $form->field($model, 'ema_02vc') ?>

    <?php // echo $form->field($model, 'dir_02vc') ?>

    <?php // echo $form->field($model, 'ncu_02vc') ?>

    <?php // echo $form->field($model, 'fna_02dt') ?>

    <?php // echo $form->field($model, 'nac_02vc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
