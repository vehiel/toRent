<?php

use app\models\Tr06cli;
use app\models\Tr10her;
use app\models\Tr09mar;
use app\models\Tr08nhr;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model12 app\models\Tr12detalq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr12detalq-form">
  <div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
      <div class="alert alert-danger">
        <h4>Para crear una nueva orden debe ingresar el primer articulo, de lo contrario no se podra crear.</h4>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div  class="panel-heading">Cliente</div>
        <div class="panel-body ">
          <?php // $form->field($model11, 'ncl_06in')->textInput() ?>

          <?= $form->field($model11, 'ncl_06in')->widget(Select2::className(),[
            'data' => ArrayHelper::map(Tr06cli::find()->asArray()->all(),'ncl_06in', function($element){
              return $element['ncl_06in'].' '.$element['nom_06vc'];
            }),
            'options' => ['placeholder' => 'Seleccionar'],
            'pluginOptions' => [
              'allowClear' => true
            ],
            ]) ?>

            <?php //$form->field($model11, 'fso_11dt')->textInput() ?>

            <?php // $form->field($model11, 'fre_11dt')->textInput() ?>

            <?php // $form->field($model11, 'fde_11dt')->textInput() ?>

            <?php // $form->field($model11, 'sto_11de')->textInput(['maxlength' => true]) ?>

            <?php // $form->field($model11, 'mto_11de')->textInput(['maxlength' => true]) ?>

            <?php //$form->field($model11, 'est_11in')->textInput() ?>
          </div>
        </div>
      </div>


      <?php/******************************************** model tr12detalq ****************************/?>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div  class="panel-heading">Artículo</div>
          <div class="panel-body ">
            <?php // $form->field($model12, 'ido_11in')->textInput() ?>

            <?= $form->field($model12, 'chr_10in')->widget(Select2::className(),[
              'data' => ArrayHelper::map(Tr10her::find()->asArray()->all(),'chr_10in', function($element){

                $marca = Tr09mar::findOne(['cgm_09in'=>$element['cgm_09in']]);
                $nom = Tr08nhr::findOne($element['idn_08in']);
                return $element['chr_10in'].' '.$nom['nom_08vc'].' '.$marca['nom_09vc'];
              }),
              'options' => ['placeholder' => 'Seleccionar'],
              'pluginOptions' => [
                'allowClear' => true,
                /*solo se puede ingresar al crear, por lo tanto si es actualizar no se puede editar este campo*/
                'disabled'=> !$model11->isNewRecord,
              ],
              ]) ?>

              <?php // $form->field($model12, 'pre_12de')->textInput(['maxlength' => true]) ?>

              <?= $form->field($model12, 'can_12in')->textInput(
                [
                  'readonly'=> !$model11->isNewRecord,
                ]
                ) ?>

                <?php // $form->field($model12, 'mto_12de')->textInput(['maxlength' => true]) ?>
              </div>
            </div>
          </div><!-- fin  class="col-md-6" de articulo-->
          <div class="col-md-6">

          </div>
          <div class="form-group col-md-6">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
          </div>

          <?php ActiveForm::end(); ?>
        </div> <!-- fin class row -->
      </div>
