<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tr11ordAlq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr11ord-alq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncl_06in')->textInput() ?>

    <?= $form->field($model, 'fso_11dt')->textInput() ?>

    <?= $form->field($model, 'fre_11dt')->textInput() ?>

    <?= $form->field($model, 'fde_11dt')->textInput() ?>

    <?= $form->field($model, 'sto_11de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mto_11de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'est_11in')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
