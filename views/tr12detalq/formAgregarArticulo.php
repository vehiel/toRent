<?php
// use app\models\Tr06cli;
use app\models\Tr10her;
use app\models\Tr09mar;
use app\models\Tr08nhr;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model12 app\models\Tr12detalq */

$this->title = Yii::t('app', 'Agregar Articulo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ordenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr12detalq-create">

  <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">


      <div class="panel panel-default">
        <div  class="panel-heading">Artículo</div>
        <div class="panel-body ">
          <div class="col-md-12">
            <div class="alert alert-danger">
              <h4>Si la herramienta seleccionada ya esta en el carrito, la cantidad ingresada se sumara a la actual.</h4>
            </div>
          </div>
          <?php $form = ActiveForm::begin(['options' => [
        'id' => 'agregarArticulo',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,]]); ?>
          <div class="col-md-12">

          <?= $form->field($model12, 'chr_10in')->widget(Select2::className(),[
            'data' => ArrayHelper::map(Tr10her::find()->asArray()->all(),'chr_10in', function($element){

              $marca = Tr09mar::findOne(['cgm_09in'=>$element['cgm_09in']]);
              $nom = Tr08nhr::findOne($element['idn_08in']);
              return $element['chr_10in'].' '.$nom['nom_08vc'].' '.$marca['nom_09vc'];
            }),
            'options' => ['placeholder' => 'Seleccionar'],
            'pluginOptions' => [
              'allowClear' => true,
              /*no se ocupa, porque siempre se va a ingresar una herramienta*/
              // 'disabled'=> !$model11->isNewRecord,
            ],
            ]) ?>

            <?= $form->field($model12, 'can_12in')->textInput(
              [
                // 'readonly'=> !$model11->isNewRecord,
              ]
              ) ?>

            </div> <!-- fin class="col-md-12" -->
            <div class="form-group col-md-12">
              <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
          </div> <!-- fin class="panel-body "-->
        </div> <!-- fin class="panel panel-default"-->
      </div> <!-- fin class="row"-->
    </div> <!-- fin class="tr12detalq-create"-->
