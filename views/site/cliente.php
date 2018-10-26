<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\models\Tr08nhr;

$this->title = 'Clientes'; 

$var = Tr08nhr::find()->select(['nom_08vc', 'h.pre_10de', 'h.ima_10vc'])
->innerJoin(['h'=>'tr10her'],'tr08nhr.idn_08in = h.idn_08in')->asArray()->all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../web/css/card.css" /> 
</head> 
<body>
<div class="container">  
    <h2 style="text-align:center"> Herramientas</h2>

    <div class="row contenedor">
        <?php 
            foreach ($var as $key) {
        ?>
        <div class="card">
            <img src="../web/uploads/herramienta/<?php  echo $key['ima_10vc']; ?>" style="width:100%">
            <h1><?php  echo $key['nom_08vc']; ?></h1>
            <p class="price">₡<?php  echo $key['pre_10de']; ?></p>
            <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moreInfo">Mas</button></p>
        </div>
        <?php
        }
        ?>
    </div> 
</div>
</body>
</html> 

<!--Modal-->

<div class="modal fade" id="moreInfo">
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
</div>

