<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tr06cli */
/* @var $form yii\widgets\ActiveForm */
/*si se utilizan modals se debe poner la siguiente sentencia, por la vara de los id unicos en los select2*/
// if($model->isNewRecord){
//     $accion = "create";
// }else{
//  $accion = "update";
// }
?>

<div class="tr06cli-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'idp_06in')->textInput() ?>

      <?= $form->field($model, 'nom_06vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'ap1_06vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'ap2_06vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'tel_06vc')->widget(MaskedInput::className(),
      ['mask'=>'9999-9999']) ?>

      <?= $form->field($model, 'gen_06in')->widget(Select2::className(),[
        'data' => ['1'=>'Masculino','0'=>'Femenino'],
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
          'allowClear' => true
        ],
        ]) ?>

      <?= $form->field($model, 'ema_06vc')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'dir_06vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'ncu_06vc')->textInput(['maxlength' => true]) ?>

      <?=  $form->field($model, 'fna_06dt')->widget(DatePicker::classname(), [
        'name'=>'fna_06dt',
        'options' => ['placeholder' => Yii::t('app','- Seleccione -'),  'autocomplete'=> 'off'],
        'pluginOptions' => [
          'format' => 'dd-mm-yyyy',
          'todayHighlight' => true,
          'autoclose' => true,
        ]
      ])?>

      <?= $form->field($model, 'nac_06vc')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'emo_06in')->widget(Select2::className(),[
        'data' => ['1'=>'Moroso','0'=>'Limpio'],
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
          'allowClear' => true
        ],
        ]) ?>
        <?= $form->field($model, 'con_06vc')->textInput(['maxlength' => true, 'value'=>'torent2018', 'readonly'=>true]) ?>

      <?= $form->field($model, 'obs_06vc')->textArea(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-lg-12">
      <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>

</div>
