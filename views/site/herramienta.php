<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = $titulo;

// $var = Tr08nhr::find()->select(['nom_08vc', 'h.pre_10de', 'h.ima_10vc'])
// ->innerJoin(['h'=>'tr10her'],'tr08nhr.idn_08in = h.idn_08in')->asArray()->all();
// $this->title = Yii::t('app','Orden: ').$model11->ido_11in;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo'), 'url' => ['catalogo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="../web/css/card.css" />
</head>
<body>-->
<div class="site-herrmienta">
  <h2 style="text-align:center" class="catalogo_title"> <?= $this->title ?></h2>

  <div class="row contenedor">
    <?php
    foreach ($var as $key) {
      ?>
      <div class="card col-lg-4 col-md-3 col-sm-4">
        <?php if($key['ima_10vc'] === null){ ?>
          <img src="../web/uploads/herramienta/noImage.jpg" style="width:100%">
        <?php }else{ ?>
          <img src="../web/uploads/herramienta/<?php  echo $key['ima_10vc']; ?>" style="width:100%">
        <?php } ?>
        <h4 ><?php  echo $key['nom_08vc'].' ('.$key['nom_09vc'].')'; ?></h4>
        <p class="price">₡<?php  echo $key['pre_10de']; ?> / mes</p>
        <!-- <a href="?r=site/herramienta&id=<?php echo $key['idn_08in'] ?>" class="btn btn-primary">Mostrar mas</a> -->
        <p>
          <button type="button" class="btn btn-primary btnMas" data-toggle="modal"
          data-target="#moreInfo" id="<?php echo $key['chr_10in'] ?>" value="?r=tr10her/mas-info&id=<?php echo $key['chr_10in'] ?>"
          >
          Más
        </button>
      </p>
    </div>
    <?php
  }
  ?>
  <!-- <div class="card col-lg-4 col-md-4">
</div> -->


</div>
</div> <!-- fin container -->
<!-- </body>
</html> -->

<!--Modal-->

<div class="modal fade" id="moreInfo">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        <!-- <h3 class="box-title">Mas información</h3> -->
      </div>

      <div class="modal-body">
        <div id="content">

        </div>
      </div>

      <div class="modal-footer">
        <input id="inputUsuario" type="hidden" value="<?php if(isset(Yii::$app->userCliente->identity->ncl_06in)){echo Yii::$app->userCliente->identity->ncl_06in;} ?>"/>
          <input id="inputHerramienta" type="hidden" value=""/>
          <div class="row">
            <div class=" col-lg-8 col-md-8 col-sm-8">
              <input class="form-control" type="number" id="inputCantidadModal" min="1"/>
            </div>
            <div class=" col-lg-4 col-md-4 col-sm-4">
              <button type="button" class="btn btn-primary btnAgregarCarrito" href='?r=tr12detalq/agregar-articulo-catalogo' onclick="agregarCarrito()">
                <span class="glyphicon glyphicon-shopping-cart"></span> Añadir a Carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script>

  $('.btnMas').on('click', function(){
  // alert("click ");
  // return;
  $('#moreInfo').find('#content').load($(this).attr('value'));

});
</script> -->


<?php $this->registerJsFile('@web/js/catalogo.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
