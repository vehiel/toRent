<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr10her-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'idn_08in')->widget(Select2::className(),[
        'data' => ArrayHelper::map($model->nombreHerramienta,'idn_08in', function($element){
          return $element['idn_08in'].' '.$element['nom_08vc'];
        }),
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
          'allowClear' => true
        ],
        ]) ?>

        <?= $form->field($model, 'cgm_09in')->widget(Select2::className(),[
          'data' => ArrayHelper::map($model->marcas,'cgm_09in', function($element){
            return $element['cgm_09in'].' '.$element['nom_09vc'];
          }),
          'options' => ['placeholder' => 'Seleccionar'],
          'pluginOptions' => [
            'allowClear' => true
          ],
          ]) ?>

          <?= $form->field($model, 'vol_10in')->widget(Select2::className(),[
            'data' => ['1'=>'110','2'=>'220', '3'=>'No aplica'],
            'options' => ['placeholder' => 'Seleccionar'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]) ?>

          <?= $form->field($model, 'des_10vc')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'vut_10in')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-6">
          <?= $form->field($model, 'gar_10in')->textInput() ?>

          <?php
          // if (!Yii::$app->isNewRecord) {
          //   echo;
          // }  ?>

          <?= $form->field($model, 'est_10in')->widget(Select2::className(),[
            'data' => ['1'=>'Activo','0'=>'Inactivo'],
            'options' => ['placeholder' => 'Seleccionar'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]) ?>

          <?= $form->field($model, 'tip_10in')->widget(Select2::className(),[
            'data' => ['1'=>'Alambrico','0'=>'Inalambrico'],
            'options' => ['placeholder' => 'Seleccionar'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]) ?>

          <?= $form->field($model, 'ser_10vc')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="form-group col-lg-6 col-md-6">
          <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>

    </div>
