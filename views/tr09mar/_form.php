<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Tr09mar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr09mar-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'nom_09vc')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'est_09in')->widget(Select2::className(),[
        'data' => ['1'=>'Activo','0'=>'Inactivo'],
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
          'allowClear' => true
        ],
        ]) ?>
      </div>
      <div class="form-group col-lg-6 col-md-6">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

  </div>
