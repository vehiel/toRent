<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tr09mar;
use app\models\Tr08nhr;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Tr10her */
$marca = Tr08nhr::findOne($model->idn_08in);
if(@$marca){
$this->title = $marca->nom_08vc;
}else
{$this->title = $model->chr_10in;}
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Herramientas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr10her-view">

  <h1><?= Html::encode($this->title) ?></h1>


  <?= DetailView::widget([
      'model' => $model,
      'attributes' => [

        // [
        //      'attribute'=>'ima_10vc',
        //      'format'=>'raw',
        //      'value'=> function($model){
        //        if($model->ima_10vc != NULL){
        //          $url = "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web').'/uploads/herramienta/'
        //          .$model->ima_10vc;
        //          $file_info = pathinfo($url);
        //          return FileInput::widget([
        //            'name' => 'comprobante',
        //            'options'=>['type'=>'file'],
        //            // 'disabled' => true,
        //            'pluginOptions' => [
        //              'initialPreview'=>[$url],
        //              'initialPreviewConfig' => [
        //                /*Se pone el downloadUrl, que muestra el boton para descargar el comprobante
        //                El key es un identificador unico para cada archivo en el inputFile, este cado como no
        //                es multiple=>true no es obligatorio
        //                El type le dice que tipo de archivo se esta cargando,
        //                muy importante para la vista previa
        //                */
        //                [
        //                  'downloadUrl'=> $url,
        //                  'key'=> 1,
        //                  /*con la info optenida del archivo se le dice que tipo de archivo es*/
        //                  'type'=> 'image',
        //                 // 'type'=> $file_info['extension'] == 'pdf'?('pdf'):('image'),
        //                  /*se pone 'showRemove'=> false en esta seccion para que no muestre
        //                  el boton de eliminar comprobante al mostrar el comprobante en cuadro del archivo(el que esta a la par del boton de zoom)*/
        //                  'showRemove'=> false,
        //                ],
        //              ],
        //              'initialPreviewAsData'=>true,
        //              'initialCaption'=>$model->ima_10vc,
        //              'showBrowse'=> false,
        //              'showUpload' => false,
        //              ] /* fin pluginOptions */
        //            ]); /* fin FileInput::widget*/
        //          } /*fin if != NULL*/
        //        } /*fin function*/
        //      ], /*fin attribute file*/
          'chr_10in',
          [
            'attribute'=>'idn_08in',
            'value'=> function($model){
              $marca = Tr08nhr::findOne($model->idn_08in);
              return $marca->nom_08vc;
            }
          ],
          [
            'attribute'=>'cgm_09in',
            'value'=> function($model){
              $marca = Tr09mar::findOne($model->cgm_09in);
              return $marca->nom_09vc;
            }
          ],
          [
            'attribute'=>'vol_10in',
            'value'=> function($model){
              if($model->vol_10in == 1){
                return "110";
              }elseif($model->vol_10in == 2){
                return "220";
              }elseif($model->vol_10in == 3){
                return "No aplica";
              }
            }
          ],
          'des_10vc',
          // 'vut_10in',
          // 'gar_10in',
          [
            'attribute'=>'tip_10in',
            'value'=> function($model){
              if($model->tip_10in == 1){
                return "Alambrico";
              }else{
                return "Inalambrico";
              }
            }
          ],
          // 'ser_10vc',
          // 'ima_10vc',
          'pre_10de',
          // 'can_10in',
      ],
  ]) ?>

</div>
