<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr10her-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idn_08in')->textInput() ?>

    <?= $form->field($model, 'cgm_09in')->textInput() ?>

    <?= $form->field($model, 'vol_10in')->textInput() ?>

    <?= $form->field($model, 'des_10vc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vut_10in')->textInput() ?>

    <?= $form->field($model, 'gar_10in')->textInput() ?>

    <?= $form->field($model, 'tip_10in')->textInput() ?>

    <?= $form->field($model, 'est_10in')->textInput() ?>

    <?= $form->field($model, 'alq_10in')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
