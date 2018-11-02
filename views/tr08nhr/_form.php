<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Tr08nhr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr08nhr-form">

  <?php $form = ActiveForm::begin(); ?>

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <?= $form->field($model, 'nom_08vc')->textInput(['maxlength' => true]) ?>

      <?php
      if($model->ima_08vc != NULL){
        $url = "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web').'/uploads/lh/'
        .$model->ima_08vc;
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
            'initialCaption'=>$model->ima_08vc,
          ]
        ]);
      }else{
        echo $form->field($model, 'file')->widget(FileInput::classname(),
        [
          'options' => ['accept' => 'image/*'],
        ]);
      }
      ?>
      <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
    <!-- <div class="form-group col-lg-7 col-md-7">

    </div> -->
  </div>

  <?php ActiveForm::end(); ?>

</div>
