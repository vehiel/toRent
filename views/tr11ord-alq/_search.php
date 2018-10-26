<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Tr11ordAlqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr11ord-alq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ido_11in') ?>

    <?= $form->field($model, 'ncl_06in') ?>

    <?= $form->field($model, 'fso_11dt') ?>

    <?= $form->field($model, 'fre_11dt') ?>

    <?= $form->field($model, 'fde_11dt') ?>

    <?php // echo $form->field($model, 'sto_11de') ?>

    <?php // echo $form->field($model, 'mto_11de') ?>

    <?php // echo $form->field($model, 'est_11in') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
