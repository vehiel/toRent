<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" style="max-width: 100%">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <div class="flex-container">
  	<div class="spinner"><p>
  		<div class="cube1"></div>
  		<div class="cube2"></div>
  		Loading...
  		</p>
  	</div>
  	<div class="flex-slide home">
  		<div class="flex-title flex-title-home">Historia</div>
  		<div class="flex-about flex-about-home"><p style ="font-size:30px;">
  		To rent tiene sus orígenes en nicoya guanacaste, nace  de una pequeña idea  que pretende solventar las necesidades y dar apoyo al sector  obrero de guanacaste poniéndoles a su alcance un gran variedad de herramientas.
  To rent tiene como eje principales la variedad , accesibilidad y es justo lo que  nos acerca a nuestros clientes  lo cual  fue de gran ayuda para iniciar en el mercado y dándonos a conocer en el mercado de renta de herramientas en la zona Guanacasteca
  </p></div>
  	</div>
  	<div class="flex-slide about">
  		<div class="flex-title">Misión</div>
  		<div class="flex-about"><p>Brindar  un servicio de calidad, dándole apoyo a  nuestros clientes con una gran variedad, accesibilidad, disponibilidad  de una alta gama de herramientas para todo los tipos de trabajo con un costo  asequible .

   </p></div>
  	</div>
  	<div class="flex-slide work">
  		<div class="flex-title">Visión</div>
  		<div class="flex-about"><p>Consolidar  una  empresa multinacional , con la mayor  cantidad de soluciones  siendo un apoyo  a todo tipo de clientes .</p>

  		</div>
  	</div>
  	<!-- <div class="flex-slide contact">
  		<div class="flex-title">Contact</div>
  				<div class="flex-about">
  					<p>Use the contact form below</p>
  					<form class="contact-form">
  						<p>Email <input type="text" name="email"></p>
  						<p>Comment <textarea type="text" name="comment" row="5"></textarea></p>
  						<p><input type="submit" name="email" value="Send Message"></p>
  					</form>

  		</div>
  	</div> -->
  </div>

    <!-- <code><?= __FILE__ ?></code> -->
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/769286/jquery.waitforimages.min.js'></script>
<script  src="../web/js/about.js"></script>
<?php //$this->registerJsFile('@web/js/about.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
