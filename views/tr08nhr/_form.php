<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Tr08nhr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr08nhr-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <?= $form->field($model, 'nom_08vc')->textInput(['maxlength' => true]) ?> 
        </div>
        <div class="form-group col-lg-7 col-md-7">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        </div>
    </div> 

    <?php ActiveForm::end(); ?>

</div>
