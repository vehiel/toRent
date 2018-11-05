<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web').'/uploads/herramienta/' -->
  <link rel="icon" href="<?php echo "http://".$_SERVER['SERVER_NAME'].Yii::getAlias('@web')."/TR.png";?>" />
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
  <?php $this->beginBody() ?>

  <div class="wrap">
    <?php
    NavBar::begin([
      'brandLabel' => Yii::$app->name,
      'brandUrl' => Yii::$app->homeUrl,
      'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
      ],
    ]);
    /*ni usuario o cliente a iniciado sesion*/
    if (Yii::$app->user->isGuest && Yii::$app->userCliente->isGuest) {
      echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
          ['label' => Yii::t('app','Inicio'), 'url' => ['/site/index']],
          // Yii::$app->user->isGuest?(
          ['label' => 'Iniciar Sesión', 'url' => ['/site/login-cliente']],
          // ):(''),
          // Yii::$app->user->isGuest?(
          ['label' => 'Usuario', 'url' => ['/site/login']],
          ['label' => 'About', 'url' => ['/site/about']]
          // ):('')
        ],
      ]);
      /*el usuario inicio sesion y se valida que legitimamente sea un usuario de la empresa*/
    }elseif(!Yii::$app->user->isGuest && isset(Yii::$app->user->identity->nus_02in)){
      echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
          ['label' => 'Inicio', 'url' => ['/site/index']],
          // ['label' => 'About', 'url' => ['/site/about']],
          // ['label' => 'Contact', 'url' => ['/site/contact']],
          ['label' => 'Usuario', 'url' => ['tr02usu/index']],
          ['label' => 'Cliente', 'url' => ['tr06cli/index']],
          ['label' => 'Nombre Herramienta', 'url' => ['tr08nhr/index']],
          ['label' => 'Marca', 'url' => ['tr09mar/index']],
          ['label' => 'Herramienta', 'url' => ['tr10her/index']],
          ['label' => 'Ordenes', 'url' => ['tr12detalq/index']],
          '<li>'
          . Html::beginForm(['/site/logout'], 'post')
          . Html::submitButton(
            'Salir (' . Yii::$app->user->identity->nom_02vc . ')',
            ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
          ],
        ]);
      }elseif(!Yii::$app->userCliente->isGuest && isset(Yii::$app->userCliente->identity->ncl_06in)){
        echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Catálogo', 'url' => ['/site/catalogo']],
            /*['label'=>'carrito','url'=>['/site/carrito']],*/
            '<li>'
            . Html::a('<span class="glyphicon glyphicon-shopping-cart"></span> '.Yii::t('app', 'Carrito'), ['carrito'], [
              // 'class' => 'btn btn-danger',
            ])
            . '</li>',
            // [
            // 'label' => Yii::t('app','Carrito'),
            // 'items' => [
            //     [
            //       'label' => 'Carrito',
            //       'url' => ['site/language','set'=>'en'],
            //       'icon'=> 'cog',
            //     ]]],
            '<li>'
            . Html::beginForm(['/site/logout-cliente'], 'post')
            . Html::submitButton(
              'Salir (' . Yii::$app->userCliente->identity->nom_06vc . ')',
              ['class' => 'btn btn-link logout']
              )
              . Html::endForm()
              . '</li>'
            ],
          ]);
        }
        NavBar::end();

        ?>

        <div class="container">
          <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
          </div>
        </div>

        <footer class="footer">
          <div class="container">
            <p class="pull-left">&copy; ToRent <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
          </div>
        </footer>

        <?php $this->endBody() ?>
      </body>
      </html>
      <?php $this->endPage() ?>
