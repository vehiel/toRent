<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr10her-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-lg-4 col-md-4">
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

          <?= $form->field($model, 'can_10in')->textInput() ?>
        </div>
        <div class="col-lg-4 col-md-4">
          <?= $form->field($model, 'pre_10de')->textInput() ?>

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

        <div class="col-lg-4 col-md-4">
          <?php
          if($model->ima_10vc != NULL){
            $url = "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web').'/uploads/herramienta/'
            .$model->ima_10vc;
            echo $form->field($model, 'file')->widget(FileInput::classname(),
            [
              'options' => ['accept' => 'image/*'],

              'pluginOptions' => [
                'initialPreview'=>[$url],
                'initialPreviewConfig' => [
                  ['downloadUrl'=> $url, 'key'=> 1,'type'=> 'image'],
                ],
                'showUpload' => false,
                'initialPreviewAsData'=>true,
                'initialCaption'=>$model->ima_10vc,
              ]
            ]);
          }else{
            echo $form->field($model, 'file')->widget(FileInput::classname(),
            [
              'options' => ['accept' => 'image/*'],
            ]);
          }
          ?>
        </div>


        <div class="form-group col-lg-12 col-md-12">
          <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>

    </div>
