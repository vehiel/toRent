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
use kartik\date\DatePicker;
use yii\helpers\Url;

use app\models\Tr06cli;
use app\models\Tr08nhr;
use app\models\Tr09mar;
use app\models\Tr10her;
use app\models\Tr12detalq;

/* @var $this yii\web\View */
/* @var $model11 app\models\Tr12detalq */
/* @var $searchModel app\models\search\Tr12detalqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Orden: ').$model11->ido_11in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ordenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*si esta vista es invocada desde actionSolicitarEntregarOrden no se mostraran los flashes como growl*/
if ($showAlertBlock) {
  echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_GROWL,
    'useSessionFlash' => true,
    'delay' => 1000,
  ]);
}


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
            [
              'attribute'=>'ncl_06in',
              'value'=>function($model11){
                $cliente = Tr06cli::findOne(['ncl_06in'=>$model11->ncl_06in]);
                if (@$cliente) {
                  return $cliente->nom_06vc.' '.$cliente->ap1_06vc.' '.$cliente->ap2_06vc;
                }else{
                  return "ni llopa";
                }
              }
            ],
            [
              'attribute'=>'fcr_11dt',
              'value'=> function($model){
                if ($model->fcr_11dt != null) {
                  return date('d-m-Y H:i:s',strtotime($model->fcr_11dt));
                }
              }
            ],
            [
              'attribute'=>'fso_11dt',
              'value'=> function($model){
                if ($model->fso_11dt != null) {
                  return date('d-m-Y H:i:s',strtotime($model->fso_11dt));
                }
              }
            ],
            [
              'attribute'=>'fre_11dt',
              'value'=> function($model){
                if ($model->fre_11dt != null) {
                  return date('d-m-Y H:i:s',strtotime($model->fre_11dt));
                }
              }
            ],
          ],
          ]) ?>
        </div>
        <div class="col-md-6">
          <?= DetailView::widget([
            'model' => $model11,
            'attributes' => [
              [
                'attribute'=>'fde_11dt',
                'value'=> function($model){
                  if ($model->fde_11dt != null) {
                    return date('d-m-Y H:i:s',strtotime($model->fde_11dt));
                  }
                }
              ],
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
                    return  "Solicitado";
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
        <div class="col-md-12 col-lg-12">
          <div class="col-lg-12 col-md-12" >
            <?php
            if($model11->est_11in === 1){
              /*************** eliminar -> ******************************/
              /*echo Html::a(Yii::t('app', 'Solicitar (para prueba)'), ['solicitar-orden', 'idOrden' => $model11->ido_11in], [
                'class' => 'btn btn-primary',
                'data' => [
                  'confirm' => Yii::t('app', 'Esta seguro que desea solicitar este alquiler?'),
                  'method' => 'post',
                ],
              ]);*/
              /*************** <- eliminar ******************************/
              echo Html::button(Yii::t('app', 'Solicitar y Entregar'),
              [
                'class' => 'btn btn-danger',
                'id'=>'btnSolicitarEntregar',
                // 'onclick'=>'javascript:solicitarEntregar('.$model11->ido_11in.')',
                'type'=>'button',
                'data-toggle'=>'modal',
                'data-target'=>'#modalFechaDevolucion',
              ]);
            }?>
            <?php
            if($model11->est_11in === 3){
              echo Html::a(Yii::t('app', 'Finalizar Alquiler'), ['finalizar-orden', 'idOrden' => $model11->ido_11in], [
                'class' => 'btn btn-primary',
                'data' => [
                  'confirm' => Yii::t('app', 'Esta seguro desea finalizar este alquiler?'),
                  'method' => 'post',
                ],
              ]);
            }?>
            <?php
            if($model11->est_11in === 2) {
              echo Html::a(Yii::t('app', 'Descartar'), ['descartar-orden', 'idOrden' => $model11->ido_11in], [
                'class' => 'btn btn-danger',
                'data' => [
                  'confirm' => Yii::t('app', 'Esta seguro que quiere descartar este alquiler?'),
                  'method' => 'post',
                ],
              ]);
            }?>
            <?php
            if($model11->est_11in === 2) {
              echo Html::button(Yii::t('app', 'Entregar'),
              [
                'class' => 'btn btn-success',
                'id'=>'btnSolicitarEntregar',
                // 'onclick'=>'javascript:solicitarEntregar('.$model11->ido_11in.')',
                'type'=>'button',
                'data-toggle'=>'modal',
                'data-target'=>'#modalFechaDevolucionEntrega',
              ]);
            }?>
          </div> <!-- fin class="col-lg-4 col-md-4"-->
        </div>
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
              [
                'attribute'=>'chr_10in',
                'value'=>function($model){
                  $herramienta = Tr10her::findOne(['chr_10in'=>$model->chr_10in]);
                  if(@$herramienta){
                    $nombre = Tr08nhr::findOne(['idn_08in'=>$herramienta->idn_08in]);
                    $marca = Tr09mar::findOne(['cgm_09in'=>$herramienta->cgm_09in]);
                    return $model->chr_10in.' - '.$nombre->nom_08vc.' ('.$marca->nom_09vc.')';
                  }
                }
              ],
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
                'buttons'=>[
                  'update'=> function($url,$model){
                    $url_ = Url::to(['update-articulo','id'=>$model->idd_12in]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url_,
                    [
                      'title'=> Yii::t('app','Actualizar'),
                      'class'=>'btnUpdateArticulo',
                      'value'=>$model->can_12in,
                    ]);
                  },
                  'delete'=> function($url,$model){
                    $url_ = Url::to(['delete-articulo','id'=>$model->idd_12in]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url_,
                    [
                      'title'=> Yii::t('app','Eliminar'),
                      'class'=>'btnDeleteArticulo',
                      'data'=>['confirm'=>Yii::t('app','Esta seguro que quiere eliminar este elemento?'),'method'=>'post'],
                    ]);
                  },
                ]
              ],
            ],
          ]); ?>
          <?php Pjax::end();?>
          <!-- 'data' => [
              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
              'method' => 'post',
          ], -->
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
      /**************************/
      Modal::begin([
        'options' => [
          'id'=>'modalFechaDevolucion',
        ],
        'size'=>'modal-md',
      ]);
      echo '
      <div class="modal-body">
      <label for="fechaDevolucion">Fecha Devolución</label>'.
      DatePicker::widget([
        'name' => 'fechaDevolucion',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
          'autoclose'=>true,
          'format' => 'dd-mm-yyyy'
        ],
        'options'=>['id'=>'fechaDevolucion']
      ])
      .'</div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" onclick="javascript:solicitarEntregar('.$model11->ido_11in.');">Solicitar y Entregar</button>
      </div>';
      Modal::end();
      /**************************/
      Modal::begin([
        'options' => [
          'id'=>'modalFechaDevolucionEntrega',
        ],
        'size'=>'modal-md',
      ]);
      echo '
      <div class="modal-body">
      <label for="fechaDevolucionEntrega">Fecha Devolución</label>'.
      DatePicker::widget([
        'name' => 'fechaDevolucionEntrega',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
          'autoclose'=>true,
          'format' => 'dd-mm-yyyy'
        ],
        'options'=>['id'=>'fechaDevolucionEntrega']
      ])
      .'</div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" onclick="javascript:entregarOrden('.$model11->ido_11in.');">Entregar</button>
      </div>';
      Modal::end();
      /**************************/
      Modal::begin([
        'options' => [
          'id'=>'modalUpdateArticulo',
        ],
        'size'=>'modal-md',
      ]);
      echo '
      <div class="modal-body">
      <label for="cantidadArticulo">Cantidad</label>
      <input class="form-control" id="cantidadArticulo" type="number"/>
      <input class="form-control" id="actualizarArticuloUrl" type="hidden"/>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" onclick="javascript:actulizarCantidadArticulo('.$model11->ido_11in.');">Actualizar</button>
      </div>';
      Modal::end();
      ?>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
      <script>
      /*redirecciona a la ruta de actualizar articulo*/
      function actulizarCantidadArticulo(idOrden){
        href = $('#actualizarArticuloUrl').val();
        cantidad = parseInt($('#cantidadArticulo').val());
        if (isNaN(cantidad)) {
          return;
        }else if(cantidad <= 0){
          return;
        }
        $(location).attr('href',href+'&can='+cantidad+'&idOrden='+idOrden);
      }
      /*cuando se hace click en un btn update del GridView muestra el modal update cantidad y agrega la cantidad actual*/
      $('.btnUpdateArticulo').on('click', function(event){
          event.preventDefault();
          cantidad = $(this).attr('value');
        href = $(this).attr('href');
          $('#modalUpdateArticulo').modal('show').find('#cantidadArticulo').val(cantidad);
          $('#modalUpdateArticulo').find('#actualizarArticuloUrl').val(href);
      });
      function entregarOrden(id){
        var fechaDevolucion = $('#fechaDevolucionEntrega').val();
        if(fechaDevolucion != ""){
          fechaDevolucion += ' 23:59:00';
          $(location).attr('href','?r=tr12detalq/entregar-orden&idOrden='+id+'&fechaDevolucion='+fechaDevolucion);
        }
        // var fecha = prompt("Ingrese fecha de confirmación", "Harry Potter");
        // if (fecha != null) {
        //   alert("fecha: "+fecha);
        // }
      } /* fin solicitarEntregar*/

      function solicitarEntregar(id){
        var fechaDevolucion = $('#fechaDevolucion').val();
        if(fechaDevolucion != ""){
          fechaDevolucion += ' 23:59:00';
          $(location).attr('href','?r=tr12detalq/solicitar-entregar-orden&idOrden='+id+'&fechaDevolucion='+fechaDevolucion);
        }
        // var fecha = prompt("Ingrese fecha de confirmación", "Harry Potter");
        // if (fecha != null) {
        //   alert("fecha: "+fecha);
        // }
      } /* fin solicitarEntregar*/
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
        // $('#modalAgregarArticulo').modal('show').find('#modalContent').load('?r=tr12detalq/agregar-articulo&id_orden=7');
      }
      $(function(){ /* doc ready*/
        // $.growl.notice({ message: '<span class="glyphicon glyphicon-ok-sign"></span> <strong>Carrito Actualizado'});
      });
      </script>
