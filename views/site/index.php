<?php

/* @var $this yii\web\View */

$this->title = 'ToRent';
?>
<style type="stylesheet">
.carousel{
margin-left: 10%;
}
</style>
<div class="site-index">
  <h1  align="center" class="catalogo_title">Bienvenido</h1>
  <h3 align="center">Algunas de nuestras marcas:</h3>
  <div id="myCarousel" class="carousel slide" style="width: 60%; height: auto; margin-left: 20%; " data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	    <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" style="height: 400px;">
	    <div class="item active">
	      <img src="../web/uploads/carrusel/i3.jpg" style="width:100%;" alt="Los Angeles">
	    </div>

	    <div class="item">
	      <img src="../web/uploads/carrusel/i4.jpg" style="width:100%;" alt="Chicago">
	    </div>

	    <div class="item">
	      <img src="../web/uploads/carrusel/i5.jpg" style="width:100%;" alt="New York">
	    </div>
      <div class="item">
        <img src="../web/uploads/carrusel/i6.jpg" style="width:100%;" alt="New York">
      </div>
      <div class="item">
        <img src="../web/uploads/carrusel/i7.jpg" style="width:100%;" alt="New York">
      </div>
	    <div class="item">
	      <img src="../web/logo.png" style="width:100%;" alt="New York">
	    </div>
      <div class="item">
        <img src="../web/uploads/carrusel/i1.png" style="width:100%;" alt="New York">
      </div>
      <div class="item">
        <img src="../web/uploads/carrusel/i2.png" style="width:100%;" alt="New York">
      </div>
	  </div>

	  <!-- Left and right controls -->
	  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	    <span class="sr-only">Anterior</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	    <span class="sr-only">Siguiente</span>
	  </a>
	</div>
  <hr />
  <div class="alert alert-success">
    <h4><a href="?r=site/login-cliente">Iniciar sesión</a> para alquilar herramientas :)</h4>
  </div>
</div>
