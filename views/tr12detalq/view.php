<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\alert\AlertBlock;
use \nterms\pagesize\PageSize;

use app\models\Tr10her;
use app\models\Tr09mar;
use app\models\Tr08nhr;
use app\models\Tr12detalq;

/* @var $this yii\web\View */
/* @var $model11 app\models\Tr12detalq */
/* @var $searchModel app\models\search\Tr12detalqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Orden: ').$model11->ido_11in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ordenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);

$model12 = new Tr12detalq();
?>
<div class="tr12detalq-view row">



  <p>
    <?php // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model11->ido_11in], ['class' => 'btn btn-primary']) ?>
    <?php /* Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model11->ido_11in], [
      'class' => 'btn btn-danger',
      'data' => [
      'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
      'method' => 'post',
    ],
    ]) */?>
  </p>
  <div class="panel panel-default">
    <div  class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
    <div class="panel-body ">
      <?php Pjax::begin(['id'=>'pjaxDetailView']); ?>
      <div class="col-md-6">
        <?= DetailView::widget([
          'model' => $model11,
          'attributes' => [
            // 'ido_11in',
            'ncl_06in',
            'fcr_11dt',
            'fso_11dt',
            'fre_11dt',
          ],
          ]) ?>
        </div>
        <div class="col-md-6">
          <?= DetailView::widget([
            'model' => $model11,
            'attributes' => [
              'fde_11dt',

              [
                'attribute'=>'mto_11de',
                'value'=>function($model){
                  return number_format($model->mto_11de,2,'.',',');
                }
              ],
              [
                'attribute'=>'est_11in',
                'value'=>function($model){
                  switch ($model->est_11in) {
                    case 0:
                    return  "Inactivo";
                    break;
                    case 1:
                    return  "Activo";
                    break;
                    case 2:
                    return  "Slicitado";
                    break;
                    case 3:
                    return  "Retirado";
                    break;
                    case 4:
                    return  "Vencido";
                    break;
                    case 5:
                    return  "Devuelto";
                    break;
                  }
                }
              ],
            ],
            ]) ?>
          </div>
          <?php Pjax::end();?>
        </div> <!--- fin class="panel-boy" -->
      </div> <!--- fin class="panel panel-default" -->
      <div id="divInputAgregarArticulo col-lg-12 col-md-12" >
        <div class="col-lg-12 col-md-12">
          <hr />
        </div>
        <?php $form = ActiveForm::begin(['options' => [
          'id' => 'agregarArticulo']]); ?>
          <div class="col-lg-4 col-md-4">
            <?= $form->field($model12, 'chr_10in')->widget(Select2::className(),[
              'data' => ArrayHelper::map(Tr10her::find()->asArray()->all(),'chr_10in', function($element){

                $marca = Tr09mar::findOne(['cgm_09in'=>$element['cgm_09in']]);
                $nom = Tr08nhr::findOne($element['idn_08in']);
                return $element['chr_10in'].' - '.$nom['nom_08vc'].' ('.$marca['nom_09vc'].')';
              }),
              'options' => ['placeholder' => 'Seleccionar', 'id'=>'inputCodigoHerramienta'],
              'pluginOptions' => [
                'allowClear' => true,
                /*no se ocupa, porque siempre se va a ingresar una herramienta*/
                // 'disabled'=> !$model11->isNewRecord,
              ],
              ]) ?>
            </div> <!-- fin class="col-lg-4 col-md-4"-->
            <div class="col-lg-4 col-md-4">
              <?= $form->field($model12, 'can_12in')->textInput(['id'=>'inputCantidad']) ?>
            </div> <!-- fin class="col-lg-4 col-md-4"-->
            <!-- <div class="form-group col-md-4 col-lg-4"> -->
            <?php /* Html::submitButton(Yii::t('app', 'Agregar Articulo'),
            [
            'class' => 'btn btn-success',
            'id'=>'btnAgregarArticulo',
            'onclick'=>'javascript:agregarArticulo('.$model11->ido_11in.')',
            'style'=>"margin-top: 25px;",
          ]
          )*/ ?>
          <!-- </div> -->
          <?php ActiveForm::end(); ?>
          <div class="col-lg-4 col-md-4" >
            <?= Html::button(Yii::t('app', 'Agregar Articulo'),
            [
              'class' => 'btn btn-success',
              'id'=>'btnAgregarArticulo',
              'onclick'=>'javascript:agregarArticulo('.$model11->ido_11in.')',
              'style'=>"margin-top: 25px;",
            ]
            )
            ?>

          </div> <!-- fin class="col-lg-4 col-md-4"-->
          <div class="col-lg-12 col-md-12">
            <hr />
          </div>
        </div> <!-- fin divInputAgregarArticulo-->

        <!-- <div class="panel panel-default col-lg-12 col-md-12">
        <div  class="panel-heading"><h4>Artículos</h4></div>
        <div class="panel-body "> -->
        <div class="col-lg-12 col-md-12">
          <div align="right">
            <label><?= Yii::t('app','Mostrando:') ?></label>
            <?php
            /*con esta vara pone la paginacion, pone como defualt 10 items, y las sizes son las diferentes cantidades disponibles a mostrar*/
             echo PageSize::widget(['defaultPageSize'=>10,
            'label'=>Yii::t('app','Elementos'),'sizes'=>['2'=>2,'5'=>5,'10'=>10,'15'=>15,'20'=>20,'50'=>50],
            'options' => ['class' => 'btn btn-default',
            'title' => Yii::t('app','Cantidad de elementos por página')]]); ?>
          </div>
          <?php Pjax::begin(['id'=>'gridviewDetalle']); ?>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterSelector' => 'select[name="per-page"]',
            'columns' => [
              ['class' => 'yii\grid\SerialColumn'],

              'idd_12in',
              'ido_11in',
              'chr_10in',
              'can_12in',
              [
                'attribute'=>'pre_12de',
                'value'=>function($model){
                  return number_format($model->pre_12de,2,'.',',');
                }
              ],
              [
                'attribute'=>'mto_12de',
                'value'=>function($model){
                  return number_format($model->mto_12de,2,'.',',');
                }
              ],

              [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} ',
              ],
            ],
          ]); ?>
          <?php Pjax::end();?>
        </div> <!-- fin class="col-lg-12 col-md-12" de gridview-->

      </div> <!-- fin class="tr12detalq-view row"-->
      <?php
      /**************************/
      Modal::begin([
        'options' => [
          'id'=>'modalAgregarArticulo',
        ],
        'size'=>'modal-md',
      ]);
      echo '<div id="modalContent"></div>';
      Modal::end();
      ?>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
      <script>
      // $('#agregarArticulo').on('submit',function(event){
      //   event.preventDefault();
      //   // alert("submit");
      // });
      function agregarArticulo(id){
        var cod = parseInt($('#inputCodigoHerramienta').val());
        var can = parseInt($('#inputCantidad').val());
        if(isNaN(cod) ){
          /*se debe deshabilitar el boton y poner un mensaje de error*/
          $('.field-inputCodigoHerramienta').addClass('has-error');
          //$('#FormFle_'+accion).submit();
          $('.field-inputCodigoHerramienta').find('.help-block').text("Codigo Herramiento no puede estar vacio.");
          return;
        }else if (isNaN(can)) {
          /*se debe deshabilitar el boton y poner un mensaje de error*/
          $('.field-inputCantidad').addClass('has-error');
          //$('#FormFle_'+accion).submit();
          $('.field-inputCantidad').find('.help-block').text("Cantidad no puede estar vacio.");
          return;
        }
        // alert("cod: "+cod+" can: "+can);
        // return;
        $.ajax({
          'url':'?r=tr12detalq/agregar-articulo',
          'dataType':'json',
          'method':'post',
          'data': {'id_orden':id,'can':can,'cod':cod},
          success: function(data){
            if(data.ok){
              /*se muestra mensajer de confirmaci[on]*/
              $.growl.notice({ message: data.msj });
              /*se pone en blanco el select2 de codigo herramienta*/
              $('#inputCodigoHerramienta').val('');
              /*ejecuta un evento change, simulando haber escogido un option*/
              $('#inputCodigoHerramienta').trigger('change');
              /*limpia el inpu de cantidad*/
              $('#inputCantidad').val("");
              /*refresca la grilla y el la tabla de la orden, se usa ,
              async:false para que fresque ambos*/
              $.pjax.reload({container:'#gridviewDetalle', async:false});
              $.pjax.reload({container:'#pjaxDetailView', async:false});

            }else{
              $.growl.error({ message: data.msj});
            }
          },
          error: function(){
            $.growl.error({ message: '<span class="glyphicon glyphicon-bullhorn"></span> <strong>Error Interno, comuniquese con soporte!</strong>'});
          }
        });
        // $('#modalAgregarArticulo').modal('show').find('#modalContent').load('?r=tr12detalq/agregar-articulo&id_orden=7')


      }
      $(function(){ /* doc ready*/
        // $.growl.notice({ message: '<span class="glyphicon glyphicon-ok-sign"></span> <strong>Carrito Actualizado'});
      });
      </script>
