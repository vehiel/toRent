<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tr02usu */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tr02usu-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'idp_02in')->textInput() ?>

      <?php // $form->field($model, 'idr_03in')->textInput() ?>

      <?= $form->field($model, 'nom_02vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'ap1_02vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'ap2_02vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'tel_02vc')->widget(MaskedInput::className(),
      ['mask'=>'9999-9999']) ?>

      <?= $form->field($model, 'gen_02in')->widget(Select2::className(),[
        'data' => ['1'=>'Masculino','0'=>'Femenino'],
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
          'allowClear' => true
        ],
        ]) ?>

        <?= $form->field($model, 'ema_02vc')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-6 col-md-6">

        <?= $form->field($model, 'dir_02vc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ncu_02vc')->textInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'fna_02dt')->textInput() ?>
        <?=  $form->field($model, 'fna_02dt')->widget(DatePicker::classname(), [
          'name'=>'fna_02dt',
          'options' => ['placeholder' => Yii::t('app','- Seleccione -'),  'autocomplete'=> 'off'],
          'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true,
            'autoclose' => true,
          ]
        ])?>

        <?= $form->field($model, 'nac_02vc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'est_02in')->widget(Select2::className(),[
          'data' => ['1'=>'Activo','0'=>'Inactivo'],
          'options' => ['placeholder' => 'Seleccionar'],
          'pluginOptions' => [
            'allowClear' => true
          ],
          ]) ?>
          <?= $form->field($model, 'con_02vc')->textInput(['maxlength' => true, 'value'=>'torent2018', 'readonly'=>true]) ?>
        </div>
        <div class="form-group col-lg-12 col-md-12">
          <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>

    </div>
