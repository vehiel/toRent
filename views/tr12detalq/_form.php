<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tr12detalq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr12detalq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ido_11in')->textInput() ?>

    <?= $form->field($model, 'chr_10in')->textInput() ?>

    <?= $form->field($model, 'pre_12de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_12in')->textInput() ?>

    <?= $form->field($model, 'mto_12de')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
