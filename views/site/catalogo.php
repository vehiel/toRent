<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\alert\AlertBlock;

$this->title = 'Catálogo';

$this->params['breadcrumbs'][] = $this->title;
AlertBlock::widget([
  'type' => AlertBlock::TYPE_GROWL,
  'useSessionFlash' => true,
  'delay' => 1000,
]);
// echo "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web')."/TR.png";
  ?>
  <!-- <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../web/css/card.css" />
  </head>
  <body> -->
    <div class="site-catalogo container">
      <h2 style="text-align:center" class="catalogo_title"> <?= $this->title ?></h2>
      <br />
      <div class="row contenedor">
        <?php
        foreach ($var as $key) {
          ?>
          <div class="card col-lg-4 col-md-3 col-sm-4">
            <?php if($key['ima_08vc'] === null){ ?>
              <img src="../web/uploads/lh/noImage.jpg" style="width:100%">
            <?php }else{ ?>
              <img src="../web/uploads/lh/<?php  echo $key['ima_08vc']; ?>" style="width:100%">
            <?php } ?>
            <h3 class="nombre_herramienta"><?php  echo $key['nom_08vc']; ?></h3>
            <p class="price">₡<?php  echo $key['pre_10de']; ?></p>
            <a href="?r=site/herramienta&id=<?php echo $key['idn_08in'] ?>" class="btn btn-primary">Mostrar más</a>
            <!-- <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moreInfo">Mas</button></p> -->
          </div>
          <?php
        }
        ?>
        <!-- <div class="card col-lg-4 col-md-4">
      </div> -->


    </div>
  </div>
<!-- </body>
</html> -->
<?php //$this->registerJsFile('@web/js/catalogo.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>



<!--Modal-->

<!-- <div class="modal fade" id="moreInfo">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        <h3 class="box-title">Mas información</h3>
      </div>

      <div class="modal-body">
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Añadir a Carrito</button>
      </div>

    </div>
  </div>
</div> -->
