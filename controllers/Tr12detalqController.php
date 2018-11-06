<?php
namespace app\controllers;

use Yii;
// use yii\helpers\Html;
use app\models\Tr08nhr;
use app\models\Tr09mar;
use app\models\Tr10her;
use app\models\Tr11ordAlq;
use app\models\Tr12detalq;

use app\models\search\Tr12detalqSearch;
use app\models\search\Tr11ordAlqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


date_default_timezone_set(Yii::$app->params['zonaHorario']);

/**
* Tr12detalqController implements the CRUD actions for Tr12detalq model.
*/
class Tr12detalqController extends Controller
{
  /**
  * {@inheritdoc}
  */
  public function behaviors()
  {
    return [
      'access'=>[
        'class'=>AccessControl::className(),
        'only'=>['index','view','update','create','delete','update-articulo'],
        'rules'=>[
          [
            'actions'=>['view','create','update','delete','index','update-articulo'],
            'allow'=>true,
            'roles'=>['@'],

          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
  * Lists all Tr12detalq models.
  * @return mixed
  */
  public function actionIndex()
  {
    $searchModel = new Tr11ordAlqSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // Yii::$app->getSession()->setFlash('default',
    // '<h4>Recuerde que las ordenes solicitadas tienen articulos bloqueados,
    // se recomienda descartarlas para que los articulos esten disponibles.</h4>');
    // Yii::$app->getSession()->setFlash('success',
    // '<h4>Recuerde que las ordenes solicitadas tienen articulos bloqueados,
    // se recomienda descartarlas para que los articulos esten disponibles.</h4>');
    // Yii::$app->getSession()->setFlash('success', [
    //     'type' => 'success',
    //     'icon' => 'fa fa-users',
    //     'message' => Yii::t('app','My Message'),
    //     'title' => Yii::t('app','My Title'),
    // ]);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single Tr12detalq model.
  * @param integer $id
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  /*el parametro $alertBlock se usa para mostrar los flashes como growl o no,
  si este action es llamada desde actionSolicitarEntregarOrden los mensajer so
  mostraran sin growl*/
  public function actionView($id,$alertBlock = true)
  {

    $model11 = Tr11ordAlq::findOne($id);
    if ($model11 == null) {
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
    }

    $searchModel = new Tr12detalqSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
    return $this->render('view', [
      'model11' => $model11,
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'showAlertBlock'=>$alertBlock,
    ]);

    // $searchModel = new Tr11ordAlqSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    /*Yii::$app->getSession()->setFlash('success',
    '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Guardado').'!</strong>');*/
    // return $this->render('index', [
    //   'searchModel' => $searchModel,
    //   'dataProvider' => $dataProvider,
    // ]);
  }

  /**
  * Creates a new Tr12detalq model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate()
  {
    $model12 = new Tr12detalq();
    $model11 = new Tr11ordAlq();
    /*si se cargan ambos modelos*/
    if ($model11->load(Yii::$app->request->post()) && $model12->load(Yii::$app->request->post())) {
      /*buscamos la orden con numero de cliente, ademas esta orden debe estar con estado 1 o 2 (Activo o Solicitado)*/
      // $orden = Tr11ordAlq::find(['ido_11in'=>$idOrden])->andWhere(['IN','est_11in',[1,2]])->one();
      $orden = Tr11ordAlq::find()->where(['ncl_06in'=>$model11->ncl_06in])->andWhere(['IN','est_11in',[1,2]])->one();
      /*si existe una orden activa para este cliente*/
      if ($orden !== null) {
        /*se busca en la tbl 12 donde el id orden sea == $orden['ido_11in'], ademas donde el codigo herramienta se igual al seleccionado
        $model12->chr_10in, si se llega a este punto es que la orden esta activa, por lo tanto no se tiene que volver a validar.
        si todo esto se cumple, es que existe una orden activa para el cliente y
        la cantidad de esa herramienta se debe aumentar y no crear un nuevo articulo en tbl 12*/
        $articulo = Tr12detalq::findOne(['ido_11in'=>$orden['ido_11in'],'chr_10in'=>$model12->chr_10in]);
        /*si la herramienta ya esta en el carrito*/
        if($articulo){
          /**********************************************************************************************************************************************/
          /**************************************ariculo ya esta en carrito*********************************************************************************/
          /**********************************************************************************************************************************************/
          /*sumamos la cantidad actual con la ingresada
          $model12 es el que viene del formulario*/
          $articulo->can_12in = $articulo->can_12in+ $model12->can_12in;
          /*se vuelve a calcular el monto total
          monto total es = el mismo + la cantidad total de herramientas en este articulo
          * el precio que ya tiene la herramienta*/
          $articulo->mto_12de += $model12->can_12in * $articulo->pre_12de;
          if($articulo->save()){
            /*si guardamos el articulo, entonces actualizamos el monto total de la orden
            se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
            $orden->sto_11de += $model12->can_12in*$articulo->pre_12de;
            $orden->mto_11de += $model12->can_12in*$articulo->pre_12de;
            if($orden->save()){
              /*se pone un mensaje de success y redirecciona a view*/
              Yii::$app->getSession()->setFlash('success',
              '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
              Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>');
              return $this->redirect(['view','id'=>$orden->ido_11in]);
            }else{/* fin if($orden->save())*/
              /*se pone un mensaje de error y redirecciona a index*/
              Yii::$app->getSession()->setFlash('error',
              '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
              Yii::t('app','$orden - No se incremento la cantidad de este articulo').'!</strong>');
              return $this->redirect(['index']);
            }
          }else{/*fin if($articulo->save())*/
            /*se pone un mensaje de error y redirecciona a index*/
            Yii::$app->getSession()->setFlash('error',
            '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','$articulo - No se incremento la cantidad de este articulo').'!</strong>');
            return $this->redirect(['index']);
          }
        } /* fin   if($articulo)*/
        /**********************************************************************************************************************************************/
        /***********************articulo no esta en carrito, agregar*********************************************************************************/
        /**********************************************************************************************************************************************/
        /*$model12 viene del formulario
        se ingresa el id orden en model de tbl 12, la orden es la que
        ya esta ingresada, por eso se usa  $orden*/
        $model12->ido_11in = $orden['ido_11in'];
        /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
        $her = Tr10her::findOne($model12->chr_10in);
        /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
        $model12->pre_12de = $her['pre_10de'];
        /*la cantidad ingresada en el formulario*/
        $model12->mto_12de =  $her['pre_10de'] * $model12->can_12in;
        /*crea elnuevo articulo*/
        if($model12->save()){
          /*si guardamos el articulo, entonces actualizamos el monto total de la orden
          se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
          $orden->sto_11de += $model12->mto_12de;
          $orden->mto_11de += $model12->mto_12de;
          /*actualizamos la orden con los nuevos datos*/
          if($orden->save()){
            /*se pone un mensaje de success y redirecciona a index*/
            Yii::$app->getSession()->setFlash('success',
            '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Artículo Agregado').'!</strong>');
            return $this->redirect(['view','id'=>$orden['ido_11in']]);
          }else{
            /*se pone un mensaje de error y redirecciona a index*/
            Yii::$app->getSession()->setFlash('error',
            '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo actualizar la orden con los montos actualizados, se ELIMINO el articulo').'!</strong>');
            /*elimina el articulo agregado, los montos no se actualizaron, por lo tanto no se tiene que recalcular*/
            $model12->delete();
            return $this->redirect(['index']);
          }
        }else{/* fin if($model12->save()){*/
          /*se pone un mensaje de error y redirecciona a index*/
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo añadir el artículo al carrito').'!</strong>');
          return $this->redirect(['index']);
        }
      } /* fin if ($orden)*/
      /**********************************************************************************************************************************************/
      /**********************************************************************************************************************************************/
      /******************fin if orden existe, inicio creacion nueva orden************************************************************/

      /* si se llega a este punto es que el cliente no tiene ninguna orden activa, por lo tanto se procede a crear*/
      /*$model11 y $model12 vienen del formulario.
      el estado es activo al principio*/
      $model11->est_11in = 1;
      /*se ingresa fecha solicitud de forma automatica*/
      $model11->fcr_11dt = Date('Y/m/d H:i:s');
      /*guardamos la orden de alquiler en la tbl 11*/
      if($model11->save()){
        /*si se guarda entonces obtenemos el id que genero y se lo pasamos a model de la tbl 12*/
        $model12->ido_11in = $model11->ido_11in;
        /*buscamos la herramienta que se esta agregando al carrito, para obtener el precio*/
        $her = Tr10her::findOne($model12->chr_10in);
        /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
        $model12->pre_12de = $her['pre_10de'];
        $model12->mto_12de =  $her['pre_10de'] * $model12->can_12in;
        /*se guarda el articulo en la tbl 12*/
        if($model12->save()){
          /* como la orden recien se esta creando, entonces el monto total de tr 11 es igual que el de tr12 porque solo tiene un articulo.
          actualizamos la orden recien guardada y le pasamos el subtotal y el monto total*/
          $model11->sto_11de = $model12->mto_12de;
          $model11->mto_11de = $model12->mto_12de;
          /*actualizamos el monto total de la orden con los nuevos datos*/
          if($model11->save()){
            /*se pone un mensaje de success y redirecciona a view*/
            Yii::$app->getSession()->setFlash('success',
            '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Orden Creada').'!</strong>');
            return $this->redirect(['view','id'=>$model11->ido_11in]);
          }else{
            /*se pone un mensaje de error y redirecciona a index*/
            Yii::$app->getSession()->setFlash('error',
            '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo crear la orden').'!</strong>');
            /*si los datos de la orden no se pueden actualiza, no se puede dejar la orden sin monto Total
            se eliminan el articulo ingresado y se elimina la orden
            la orden esta recien creada, no afecta si se elimina*/
            $model12->delete();
            $model11->delete();
            return $this->redirect(['index']);
          }
        }else{/* fin if($model12->save()){*/
          /*se pone un mensaje de error y redirecciona a View
          la orden no se elimina, se deja sin el primer articulo*/
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','Orden Creada, pero ocurrio un error al ingresar el artículo').'!</strong><br />Trate de ingresarlo de nuevo');
          return $this->redirect(['view','id'=>$model11->ido_11in]);
        }
      }else{ /*fin primer if($model11->save())*/
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo guardar la orden').'!</strong>');
        return $this->redirect(['index']);
      }
    } /* fin if ($model11->load(Yii::$app->request->post()) && $model12->load(Yii::$app->request->post()))*/

    return $this->render('create', [
      'model12' => $model12,
      'model11'=> $model11,
    ]);
  }

  /**
  * Updates an existing Tr12detalq model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $id
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionUpdate($id)
  {
    $model11 = Tr11ordAlq::findOne($id);
    if($model11 == null){
      throw new NotFoundHttpException(Yii::t('app', 'tr 11 - Recurso no encontrado.'));
    }
    if($model11->est_11in != 1){ /*estado 1 => Activo, solo si esta activo se puede editar, en los demas estado no*/
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','Esta orden no se puede editar').'!</strong>');
      return $this->redirect(['index']);
    }
    $model12 = Tr12detalq::findOne(['ido_11in'=>$model11->ido_11in]);
    if($model12 == null){
      throw new NotFoundHttpException(Yii::t('app', 'tr 12 - Recurso no encontrado.'));
    }
    if ($model11->load(Yii::$app->request->post()) && $model12->load(Yii::$app->request->post())) {
      return $this->redirect(['index']);
    }

    return $this->render('update', [
      'model12' => $model12,
      'model11'=> $model11,
    ]);
  }

  /**
  * Deletes an existing Tr12detalq model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $id
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionDelete($id)
  {
    /*obtenemos el modelo de la tbl 11 donde id orden == $id*/
    $model11 = Tr11ordAlq::findOne($id);
    if($model11 == null){
      throw new NotFoundHttpException(Yii::t('app', 'tr 11 - Recurso no encontrado.'));
    }
    /*si esta orden esta en un estado diferente de Activo (1), no se puede Eliminar*/
    if($model11->est_11in != 1){
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se pudo Eliminar esta orden').'!</strong>');
      return $this->redirect(['index']);
    }
    /*si se puede eliminar buscamos los modelos de tbl 12 que estan ligados a la orden a eliminar*/
    $model12 = Tr12detalq::find(['ido_11in'=>$id])->all();
    if($model12 == null){
      throw new NotFoundHttpException(Yii::t('app', 'tr 11 - Recurso no encontrado.'));
    }
    /*se hace un foreach para eliminar cada articulo*/
    foreach ($model12 as $key) {
      $key->delete();
    }
    /*luego se elimina la orden*/
    $model11->delete();
    Yii::$app->getSession()->setFlash('success',
    '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Orden eliminada').'!</strong>');
    return $this->redirect(['index']);
  }

  /**
  * Finds the Tr12detalq model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $id
  * @return Tr12detalq the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = Tr12detalq::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }

  public function actionAgregarArticulo(){
    $codigoHerramienta = (int)$_POST['cod'];
    $cantidad = (int)$_POST['can'];
    $idOrden = (int)$_POST['id_orden'];
    // $codigoHerramienta = 5;
    // $cantidad = 1;
    // $idOrden = 7;

    // $model11 = new Tr11ordAlq;
    // if ($model12->load(Yii::$app->request->post())) {

    // $orden = Tr11ordAlq::find(['ido_11in'=>$idOrden])->andWhere(['IN','est_11in',[1,2]])->one();
    $orden = Tr11ordAlq::findOne(['ido_11in'=>$idOrden]);

    if ($orden !== null) {
      /*solo se puede agregar un articulo si la orden esta activa o solicitada*/
      if ($orden['est_11in'] != 1 && $orden['est_11in'] != 2) {
        /*no se pueden agregar mas articulos a esta orden*/
        $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pueden agregar mas articulos a esta orden').'!</strong>'];
        echo json_encode($res);
        exit();
      }
      /*se busca en la tbl 12 donde el id orden sea == $idOrden, ademas donde el codigo herramienta se igual al seleccionado
      $model12->chr_10in, si se llega a este punto es que la orden esta activa, por lo tanto no se tiene que volver a validar.
      si todo esto se cumple, es que existe una orden activa para el cliente y
      la cantidad de esa herramienta se debe aumentar y no crear un nuevo articulo en tbl 12*/
      $articulo = Tr12detalq::findOne(['ido_11in'=>$idOrden,'chr_10in'=>$codigoHerramienta]);
      /*si la herramienta ya esta en el carrito*/
      if($articulo){
        /**********************************************************************************************************************************************/
        /**************************************ariculo ya esta en carrito*********************************************************************************/
        /**********************************************************************************************************************************************/
        /*sumamos la cantidad actual con la ingresada*/
        $articulo->can_12in += $cantidad;
        /*se vuelve a calcular el monto total
        monto total es = a la cantidad total de herramientas en este item * el precio que ya tiene la herramienta*/
        $articulo->mto_12de = $articulo->can_12in * $articulo->pre_12de;
        if($articulo->save()){
          /*si guardamos el articulo, entonces actualizamos el monto total de la orden
          se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden.
          al subtotal y monto total se le tiene que sumar la nueva cantidad * precio, si se suma
          el monto total del articulo esta sumando doble, porque previamente ya estaba sumado el monto total
          de ese articulo con la cantidad anterior*/
          $orden->sto_11de += ($cantidad*$articulo->pre_12de);
          $orden->mto_11de += ($cantidad*$articulo->pre_12de);
          if($orden->save()){
            /*se pone un mensaje de success y termina el proceso*/
            $res = ['ok'=>true,'msj'=>'<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
            Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>'];
            echo json_encode($res);
            exit();
          }else{
            /*se pone un mensaje de error y termina el proceso*/
            $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','$orden - No se incremento la cantidad de este articulo').'!</strong>'];
            echo json_encode($res);
            exit();
          }
        }else{ /* fin if($articulo->save())*/
          /*se pone un mensaje de error y termina el proceso*/
          $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','$articulo - No se incremento la cantidad de este articulo').'!</strong>'];
          echo json_encode($res);
          exit();
        }
      } /* fin if($articulo)*/
      /**********************************************************************************************************************************************/
      /***********************articulo no esta en carrito, agregar*********************************************************************************/
      /**********************************************************************************************************************************************/
      /* se crea un nuevo detalle*/
      $model12 = new Tr12detalq();
      /*se ingresa el id orden en model de tbl 12*/
      $model12->ido_11in = $idOrden;
      /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
      $her = Tr10her::findOne($codigoHerramienta);
      /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
      $model12->chr_10in = $codigoHerramienta;
      $model12->pre_12de = $her['pre_10de'];
      $model12->can_12in = $cantidad;
      $model12->mto_12de =  $her['pre_10de'] * $cantidad;
      if($model12->save()){
        /*si guardamos el articulo, entonces actualizamos el monto total de la orden
        se usa orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
        $orden->sto_11de += $model12->mto_12de;
        $orden->mto_11de += $model12->mto_12de;
        /*actualizamos la orden con los nuevos datos*/
        if($orden->save()){
          /*se pone un mensaje de success y termina el proceso*/
          $res = ['ok'=>true,'msj'=>'<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Artículo Agregado').'!</strong>'];
          echo json_encode($res);
          exit();
        }else{
          /*se pone un mensaje de success y termina el proceso*/
          $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','No se pudo actualizar la orden con los montos actualizados, se ELIMINO el articulo').'!</strong>'];
          /*elimina el articulo agregado, los montos no se actualizaron, por lo tanto no se tiene que recalcular*/
          $model12->delete();
          echo json_encode($res);
          exit();
        }
      }else{/* fin if($model12->save()){*/
        /*se pone un mensaje de success y termina el proceso*/
        $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo añadir el articulo al carrito').'!</strong>'];
        echo json_encode($res);
        exit();
      }
    }else{ /* fin if ($orden)*/
      /*se pone un mensaje de success y termina el proceso*/
      $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se puede agregar artículos a esta orden').'!</strong>'];
      echo json_encode($res);
      exit();
    }
    // }
  } /* fin actionAgregarArticulo*/

  public function actionSolicitarEntregarOrden($idOrden,$fechaDevolucion){
    $model11 = Tr11ordAlq::findOne((int)$idOrden);
    /*si no existe el modelo, manda error*/
    if($model11 === null){
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
      /*solo se puede solicitar si esta Activo*/
    }elseif ($model11->est_11in != 1) {
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','Este Orden no se puede solicitar ni entregar').'!</strong>');
      return $this->redirect(['view','id'=>$idOrden]);
    }
    $mensajes = [];
    $mensajes[]= '<span class="glyphicon glyphicon-bullhorn"></span> <strong>Recuerde que ninguna herramienta esta reservada hasta que la orden este solicitada</strong>';
    /*valida las cantidades de los articulos que se pretenden alquilar*/
    /*obtenemos todos los articulos de la orden*/
    /*si se pone find(['ido_11in'=>10])->all(); devolvera todos los registros, por eso se usa el where*/
    $articulos = Tr12detalq::find()->where(['ido_11in'=>$idOrden])->all();

    /*se recorre cada articulo*/
    foreach ($articulos as $articulo) {
      /*obtenemos la herramienta a alquilar*/
      $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
      /*si la cantidad de herramientas en inventario es menor que la cantidad a descontar,
      entonces no se puede alquilar*/
      if($herramienta['can_10in'] < $articulo['can_12in']){
        /*obtenemos el nombre y la marca de la herramienta para mostrar un mensaje mas detallado*/
        $nombre = Tr08nhr::findOne($herramienta['idn_08in']);
        $marca = Tr09mar::findOne($herramienta['cgm_09in']);
        $mensajes[]=  'Cantidad insuficiente de '.$nombre['nom_08vc'].
        '(s) '.$marca['nom_09vc'].' con <strong>codigo de herramienta: </strong>'.$herramienta['chr_10in'].
        '. <br />Cantidad en inventario: '.$herramienta['can_10in'].'.';
      }
    }
    /*si hay mas de un mensajer, se muestran los errores.
    tiene que ser mayor que 1, porque el primer mensaje es agregado al crear el array*/
    if (sizeof($mensajes) > 1) {
      Yii::$app->getSession()->setFlash('error',$mensajes);
      return $this->redirect(['view','id'=>$idOrden,'alertBlock'=>false]);
    }
    /*si hay insuficiente cantidad de caa articulo en inventario hace la transaccion*/
    $tran = Yii::$app->db->beginTransaction();
    try {
      /*si todo esta bien, se ingresan los datos necesarios*/
      $model11->est_11in = 3; /*retirado*/
      $model11->fso_11dt = Date('Y/m/d H:i:s');
      $model11->fre_11dt = Date('Y/m/d H:i:s');
      $model11->fde_11dt  = Date('Y/m/d H:i:s', strtotime($fechaDevolucion));
      $model11->nus_ent_02in = Yii::$app->user->identity->nus_02in;
      if ($model11->save(false)) {
        /*se recorre cada articulo*/
        foreach ($articulos as $articulo) {
          /*obtenemos la herramienta a alquilar*/
          $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
          /*descontamos la cantidad de cada articulo del inventario*/
          $herramienta->can_10in -= $articulo->can_12in;
          $herramienta->save(false);
        }
        Yii::$app->getSession()->setFlash('success',
        '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
        Yii::t('app','Orden Entregada').'!</strong>');
        $tran->commit();
        return $this->redirect(['view','id'=>$idOrden]);
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo Entregar la orden').'!</strong>');
        $tran->rollBack();
        return $this->redirect(['view','id'=>$idOrden]);
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }/* fin actionSolicitarEntregarOrden*/
  /***************************************************************************************/
  /***************************************************************************************/
  public function actionFinalizarOrden($idOrden){

    $model11 = Tr11ordAlq::findOne((int)$idOrden);
    if($model11 === null){
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
      /*solo ordenes retiradas se oueden finalizar*/
    }elseif ($model11->est_11in != 3) {/*retirado*/
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','Esta Orden no se puede finalizar').'!</strong>');
      return $this->redirect(['view','id'=>$idOrden]);
    }
    $tran = Yii::$app->db->beginTransaction();
    try {
      /*pone estado finalizado*/
      $model11->est_11in = 5;

      if ($model11->save(false)) {
        /*de vuelve articulos a inventario*/
        /*obtenemos todos los articulos de la orden*/
        /*si se pone find(['ido_11in'=>10])->all(); devolvera todos los registros, por eso se usa el where*/
        $articulos = Tr12detalq::find()->where(['ido_11in'=>$idOrden])->all();
        /*se recorre cada articulo*/
        foreach ($articulos as $articulo) {
          /*obtenemos la herramienta a alquilar*/
          $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
          /*devolvemos la cantidad de cada articulo del inventario*/
          $herramienta->can_10in += $articulo->can_12in;
          $herramienta->save(false);
        }
        Yii::$app->getSession()->setFlash('success',
        '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
        Yii::t('app','Orden finalizada').'!</strong>');
        $tran->commit();
        return $this->redirect(['view','id'=>$idOrden]);
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo finalizar la orden').'!</strong>');
        $tran->rollBack();
        return $this->redirect(['view','id'=>$idOrden]);
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  } /*fin actionFinalizarOrden*/
  /***************************************************************************************/
  /***************************************************************************************/
  public function actionSolicitarOrden($idOrden, $esUsuario = true){
    $model11 = Tr11ordAlq::findOne((int)$idOrden);
    if($model11 === null){
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
      /*solo ordenes activas se pueden solicitar*/
    }elseif ($model11->est_11in != 1) {/*activo*/
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','Esta Orden no se puede solicitar').'!</strong>');
      /*si la consulta es del lado de usuario redirecciona a view*/
      if($esUsuario){
      return $this->redirect(['view','id'=>$idOrden]);
      /*si no, redirecciona a site/carrito*/
    }else{
      return $this->redirect(['site/carrito']);
    }
    }
    $mensajes = [];
    $mensajes[]= '<span class="glyphicon glyphicon-bullhorn"></span> <strong>Recuerde que ninguna herramienta esta reservada hasta que la orden este solicitada</strong>';
    /*valida las cantidades de los articulos que se pretenden alquilar*/
    /*obtenemos todos los articulos de la orden*/
    /*si se pone find(['ido_11in'=>10])->all(); devolvera todos los registros, por eso se usa el where*/
    $articulos = Tr12detalq::find()->where(['ido_11in'=>$idOrden])->all();

    /*se recorre cada articulo*/
    foreach ($articulos as $articulo) {
      /*obtenemos la herramienta a alquilar*/
      $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
      /*si la cantidad de herramientas en inventario es menor que la cantidad a descontar,
      entonces no se puede alquilar*/
      if($herramienta['can_10in'] < $articulo['can_12in']){
        /*obtenemos el nombre y la marca de la herramienta para mostrar un mensaje mas detallado*/
        $nombre = Tr08nhr::findOne($herramienta['idn_08in']);
        $marca = Tr09mar::findOne($herramienta['cgm_09in']);
        $mensajes[]=  'Cantidad insuficiente de '.$nombre['nom_08vc'].
        '(s) '.$marca['nom_09vc'].' con <strong>codigo de herramienta: </strong>'.$herramienta['chr_10in'].
        '. <br />Cantidad en inventario: '.$herramienta['can_10in'].'.';
      }
    }
    /*si hay mas de un mensajer, se muestran los errores.
    tiene que ser mayor que 1, porque el primer mensaje es agregado al crear el array*/
    if (sizeof($mensajes) > 1) {
      Yii::$app->getSession()->setFlash('error',$mensajes);
      /*si la consulta es del lado de usuario redirecciona a view*/
      if($esUsuario){
      return $this->redirect(['view','id'=>$idOrden,'alertBlock'=>false]);
      /*si no, redirecciona a site/carrito*/
    }else{
      return $this->redirect(['site/carrito','alertBlock'=>false]);
    }

    }
    $tran = Yii::$app->db->beginTransaction();
    try {
      /*pone estado finalizado*/
      $model11->est_11in = 2;
      $model11->fso_11dt = Date('Y/m/d H:i:s');
      if ($model11->save(false)) {
        /*obtenemos todos los articulos de la orden*/
        /*se recorre cada articulo*/
        foreach ($articulos as $articulo) {
          /*obtenemos la herramienta a alquilar*/
          $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
          /*devolvemos la cantidad de cada articulo del inventario*/
          $herramienta->can_10in -= $articulo->can_12in;
          $herramienta->save(false);
        }
        Yii::$app->getSession()->setFlash('success',
        '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
        Yii::t('app','Alquiler solicitado').'!</strong>');
        $tran->commit();
        /*si la consulta es del lado de usuario redirecciona a view*/
        if($esUsuario){
        return $this->redirect(['view','id'=>$idOrden]);
        /*si no, redirecciona a site/carrito*/
      }else{
        return $this->redirect(['site/carrito']);
      }
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo solicitar este alquiler').'!</strong>');
        $tran->rollBack();
        /*si la consulta es del lado de usuario redirecciona a view*/
        if($esUsuario){
        return $this->redirect(['view','id'=>$idOrden]);
        /*si no, redirecciona a site/carrito*/
      }else{
        return $this->redirect(['site/carrito']);
      }
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  } /* fin actionSolicitarOrden*/
  /***************************************************************************************/
  /***************************************************************************************/
  public function actionDescartarOrden($idOrden){
    $model11 = Tr11ordAlq::findOne((int)$idOrden);
    if($model11 === null){
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
      /*solo descartar ordenes solicitadas*/
    }elseif ($model11->est_11in != 2) {/*solicitado*/
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','Esta Orden no se puede solicitar').'!</strong>');
      return $this->redirect(['view','id'=>$idOrden]);
    }
    $tran = Yii::$app->db->beginTransaction();
    try {
      /*pone activo finalizado*/
      $model11->est_11in = 1;
      $model11->fso_11dt = null;
      if ($model11->save(false)) {
        /*se devuelven articulos a inventario
        obtenemos todos los articulos de la orden*/
        /*si se pone find(['ido_11in'=>10])->all(); devolvera todos los registros, por eso se usa el where*/
        $articulos = Tr12detalq::find()->where(['ido_11in'=>$idOrden])->all();
        /*se recorre cada articulo*/
        foreach ($articulos as $articulo) {
          /*obtenemos la herramienta a alquilar*/
          $herramienta = Tr10her::findOne(['chr_10in'=>$articulo['chr_10in']]);
          /*devolvemos la cantidad de cada articulo del inventario*/
          $herramienta->can_10in += $articulo->can_12in;
          $herramienta->save(false);
        }
        Yii::$app->getSession()->setFlash('success',
        '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
        Yii::t('app','Alquiler descartado').'!</strong>');
        $tran->commit();
        return $this->redirect(['view','id'=>$idOrden]);
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo descartado este alquiler').'!</strong>');
        $tran->rollBack();
        return $this->redirect(['view','id'=>$idOrden]);
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  } /* fin actionDescartarOrden*/
  /***************************************************************************************/
  /***************************************************************************************/
  public function actionEntregarOrden($idOrden,$fechaDevolucion){
    $model11 = Tr11ordAlq::findOne((int)$idOrden);
    /*si no existe el modelo, manda error*/
    if($model11 === null){
      throw new NotFoundHttpException(Yii::t('app', 'Recurso no encontrado.'));
      /*solo se puede entregar si esta solicitado*/
    }elseif ($model11->est_11in != 2) {
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','Este Orden no se puede entregar').'!</strong>');
      return $this->redirect(['view','id'=>$idOrden]);
    }
    $tran = Yii::$app->db->beginTransaction();
    try {
      /*si todo esta bien, se ingresan los datos necesarios*/
      $model11->est_11in = 3; /*retirado*/
      // $model11->fso_11dt = Date('Y/m/d H:i:s');
      $model11->fre_11dt = Date('Y/m/d H:i:s');
      $model11->fde_11dt  = Date('Y/m/d H:i:s', strtotime($fechaDevolucion));
      $model11->nus_ent_02in = Yii::$app->user->identity->nus_02in;
      if ($model11->save(false)) {
        Yii::$app->getSession()->setFlash('success',
        '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
        Yii::t('app','Orden Entregada').'!</strong>');
        $tran->commit();
        return $this->redirect(['view','id'=>$idOrden]);
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo Entregar la orden').'!</strong>');
        $tran->rollBack();
        return $this->redirect(['view','id'=>$idOrden]);
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }/* fin actionEntregarOrden*/

  /***************************************************************************************/
  /***************elimina un articulo del carrito USUARIO********************************************************/
  public function actionDeleteArticulo($id){
    $model = $this->findModel($id);
    $orden = Tr11ordAlq::findOne(['ido_11in'=>$model->ido_11in]);
    /*solo se puede eliminar un articulo si la orden esta activa o solicitada*/
    if ($orden['est_11in'] != 1 && $orden['est_11in'] != 2) {
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se pueden eliminar articulos de esta orden').'!</strong>');
      return $this->redirect(['view','id'=>$orden->ido_11in]);
    }

    $tran = Yii::$app->db->beginTransaction();
    try{
      $orden->mto_11de -= $model->mto_12de;
      $orden->sto_11de -= $model->mto_12de;
      if ($orden->save(false)) {
        if($model->delete(false)){
          $tran->commit();
          Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Articulo eliminado').'!</strong>');
          return $this->redirect(['view','id'=>$orden->ido_11in]);
        }else{
          $tran->rollBack();
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','No se pudo eliminar el articulo').'!</strong>');
          return $this->redirect(['view','id'=>$orden->ido_11in]);
        }
      }else{
        $tran->rollBack();
      }

    }catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }

  /***************************************************************************************/
  /********Eliminar articulo de carrito CLIENTE************************************************/
  public function actionDeleteArticuloCliente($id){
    /*con el id del detalle buscamos el modelo*/
    $model = $this->findModel($id);
    /*con el id orden que tiene el detalle se busca la orden, para actualizar los montos*/
    $orden = Tr11ordAlq::findOne(['ido_11in'=>$model->ido_11in]);
    /*solo se puede eliminar un articulo si la orden esta activa o solicitada*/
    if ($orden['est_11in'] != 1 && $orden['est_11in'] != 2) {
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se pueden eliminar articulos de esta orden').'!</strong>');
      /*se redirecciona al carrito*/
      return $this->redirect(['site/carrito']);
    }

    $tran = Yii::$app->db->beginTransaction();
    try{
      $orden->mto_11de -= $model->mto_12de;
      $orden->sto_11de -= $model->mto_12de;
      if ($orden->save(false)) {
        if($model->delete(false)){
          $tran->commit();
          Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Articulo eliminado').'!</strong>');
          return $this->redirect(['site/carrito']);
        }else{
          $tran->rollBack();
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','No se pudo eliminar el articulo').'!</strong>');
          return $this->redirect(['site/carrito']);
        }
      }else{
        $tran->rollBack();
      }

    }catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }

  /***************************************************************************************/
  /**********Actualiza la cantidad USUARIO*************************************/
  public function actionUpdateArticulo($id,$can,$idOrden){
    $can = (int)$can;
    $articulo = $this->findModel($id);
    $orden = Tr11ordAlq::findOne(['ido_11in'=>$idOrden]);
    if($orden === null){
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se encontro la orden').'!</strong>');
      return $this->redirect(['view','id'=>$idOrden]);
    }
    $tran = Yii::$app->db->beginTransaction();
    try{
      /*se saca la diferencia entre la cantidad actual y la nueva cantidad del articulo*/
      $diferencia = $can - $articulo->can_12in;
      $orden->mto_11de += ($diferencia * $articulo->pre_12de);
      $orden->sto_11de += ($diferencia * $articulo->pre_12de);
      if ($orden->save(false)) {
        $articulo->can_12in = $can;
        $articulo->mto_12de = $articulo->pre_12de * $can;
        if ($articulo->save(false)) {
          $tran->commit();
          Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Cantidad de articulo actualizada').'!</strong>');
          return $this->redirect(['view','id'=>$idOrden]);
        }else{
          $tran->rollBack();
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','Error al actualizar la cantidad').'!</strong>');
          return $this->redirect(['view','id'=>$idOrden]);
        }
      }else{
        $tran->rollBack();
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','Error al actualizar la cantidad').'!</strong>');
        return $this->redirect(['view','id'=>$idOrden]);
      }

    }catch(Exception $e){
      $tran->rollBack();
      throw $e;
    }
    $articulo->can_12in = $can;

  }
  /***************************************************************************************/
  /**********Actualiza la cantidad CLIENTE*************************************/
  public function actionUpdateArticuloCliente($id,$can,$idOrden){
    $can = (int)$can;
    $articulo = $this->findModel($id);
    $orden = Tr11ordAlq::findOne(['ido_11in'=>$idOrden]);
    if($orden === null){
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se encontro la orden').'!</strong>');
      return $this->redirect(['site/carrito']);
    }
    $tran = Yii::$app->db->beginTransaction();
    try{
      /*se saca la diferencia entre la cantidad actual y la nueva cantidad del articulo*/
      $diferencia = $can - $articulo->can_12in;
      $orden->mto_11de += ($diferencia * $articulo->pre_12de);
      $orden->sto_11de += ($diferencia * $articulo->pre_12de);
      if ($orden->save(false)) {
        $articulo->can_12in = $can;
        $articulo->mto_12de = $articulo->pre_12de * $can;
        if ($articulo->save(false)) {
          $tran->commit();
          Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Cantidad de articulo actualizada').'!</strong>');
          return $this->redirect(['site/carrito']);
        }else{
          $tran->rollBack();
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','Error al actualizar la cantidad').'!</strong>');
          return $this->redirect(['site/carrito']);
        }
      }else{
        $tran->rollBack();
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','Error al actualizar la cantidad').'!</strong>');
        return $this->redirect(['site/carrito']);
      }

    }catch(Exception $e){
      $tran->rollBack();
      throw $e;
    }
    $articulo->can_12in = $can;

  }
  /***************************************************************************************/
  /***************************************************************************************/
  public function actionTran(){
    $mar = new Tr09mar();
    $model = new Tr11ordAlq;
    $tran = Yii::$app->db->beginTransaction();
    try {
      $mar->nom_09vc="prueba tran";
      $mar->est_09in="0";
      /*se debe poner save(false) porque la clase ActiveRecord maneja los errores
      independiende y si algo da error no va a caer en el catch*/
      $mar->save(false);

      $model->ncl_06in=33;
      $model->est_11in=0;
      $model->save(false);
      $tran->commit();
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }

  public function actionAgregarArticuloCatalogo(){
    $ncl_06in = (int)$_POST['ncl_06in'];
    $chr_10in = (int)$_POST['chr_10in'];
    $can_12in = intval($_POST['can_12in']);
    if ($can_12in <= 0) {
      $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','La cantidad tiene que ser mayor que cero').'!</strong>'];
      echo json_encode($res);
      exit();
    }
    $tran = Yii::$app->db->beginTransaction();
    /*buscamos la orden con numero de cliente, ademas esta orden debe estar con estado 1 o 2 (Activo o Solicitado)*/
    // $orden = Tr11ordAlq::find(['ido_11in'=>$idOrden])->andWhere(['IN','est_11in',[1,2]])->one();
    try{
      $orden = Tr11ordAlq::find()->where(['ncl_06in'=>$ncl_06in])->andWhere(['IN','est_11in',[1,2]])->one();
      /*si existe una orden activa para este cliente*/
      if ($orden !== null) {
        /*se busca en la tbl 12 donde el id orden sea == $orden['ido_11in'], ademas donde el codigo herramienta se igual al seleccionado
        $chr_10in, si se llega a este punto es que la orden esta activa, por lo tanto no se tiene que volver a validar.
        si todo esto se cumple, es que existe una orden activa para el cliente y
        la cantidad de esa herramienta se debe aumentar y no crear un nuevo articulo en tbl 12*/
        $articulo = Tr12detalq::findOne(['ido_11in'=>$orden['ido_11in'],'chr_10in'=>$chr_10in]);
        /*si la herramienta ya esta en el carrito*/
        if($articulo !== null){
          /**********************************************************************************************************************************************/
          /**************************************ariculo ya esta en carrito*********************************************************************************/
          /**********************************************************************************************************************************************/
          /*sumamos la cantidad actual con la ingresada*/
          $articulo->can_12in += $can_12in;
          /*se vuelve a calcular el monto total
          monto total es = el mismo + la cantidad total de herramientas en este articulo
          * el precio que ya tiene la herramienta*/
          $articulo->mto_12de += $can_12in * $articulo->pre_12de;
          if($articulo->save(false)){
            /*si guardamos el articulo, entonces actualizamos el monto total de la orden
            se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
            $orden->sto_11de += $can_12in*$articulo->pre_12de;
            $orden->mto_11de += $can_12in*$articulo->pre_12de;
            if($orden->save(false)){
              /*se pone un mensaje de success */
              // Yii::$app->getSession()->setFlash('success',
              // '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
              // Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>');
              $tran->commit();
              $res = ['ok'=>true,'msj'=>'<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
              Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>'];
              echo json_encode($res);
              exit();
            }else{/* fin if($orden->save())*/
              $tran->rollBack();
              $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
              Yii::t('app','$orden - No se incremento la cantidad de este articulo').'!</strong>'];
              echo json_encode($res);
              exit();
            }
          }else{/*fin if($articulo->save())*/
            $tran->rollBack();
            $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','$articulo - No se incremento la cantidad de este articulo').'!</strong>'];
            echo json_encode($res);
            exit();
          }
        } /* fin   if($articulo)*/
        /**********************************************************************************************************************************************/
        /***********************articulo no esta en carrito, agregar*********************************************************************************/
        /**********************************************************************************************************************************************/
        $model12 = new Tr12detalq();
        /*se ingresa el id orden en model de tbl 12, la orden es la que
        ya esta ingresada, por eso se usa  $orden*/

        $model12->ido_11in = $orden['ido_11in'];
        $model12->chr_10in = $chr_10in;
        $model12->can_12in = $can_12in;
        /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
        $her = Tr10her::findOne($chr_10in);
        /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
        $model12->pre_12de = $her['pre_10de'];
        /*la cantidad que viene desde el cliente*/
        $model12->mto_12de =  $her['pre_10de'] * $can_12in;
        /*crea elnuevo articulo*/
        if($model12->save(false)){
          /*si guardamos el articulo, entonces actualizamos el monto total de la orden
          se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
          $orden->sto_11de += $model12->mto_12de;
          $orden->mto_11de += $model12->mto_12de;
          /*actualizamos la orden con los nuevos datos*/
          if($orden->save()){
            /*se pone un mensaje de success */
            $tran->commit();
            $res = ['ok'=>true,'msj'=>'<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
            Yii::t('app','Artículo Agregado').'!</strong>'];
            echo json_encode($res);
            exit();
          }else{
            $tran->rollBack();
            $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','No se pudo actualizar la orden con los montos actualizados, se ELIMINO el articulo').'!</strong>'];
            echo json_encode($res);
            exit();
          }
        }else{/* fin if($model12->save()){*/

          $tran->rollBack();
          $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','No se pudo añadir el artículo al carrito').'!</strong>'];
          echo json_encode($res);
          exit();
        }
      } /* fin if ($orden)*/
      /**********************************************************************************************************************************************/
      /**********************************************************************************************************************************************/
      /******************fin if orden existe, inicio creacion nueva orden************************************************************/
      $model11 = new Tr11ordAlq;
      $model12 = new Tr12detalq;
      /* si se llega a este punto es que el cliente no tiene ninguna orden activa, por lo tanto se procede a crear*/
      /*
      el estado es activo al principio*/
      $model11->est_11in = 1;
      /*se ingresa fecha solicitud de forma automatica*/
      $model11->fcr_11dt = Date('Y/m/d H:i:s');
      /*se agrega el cliente*/
      $model11->ncl_06in = $ncl_06in;
      /*guardamos la orden de alquiler en la tbl 11*/
      if($model11->save(false)){
        /*si se guarda entonces obtenemos el id que genero y se lo pasamos a model de la tbl 12*/
        $model12->ido_11in = $model11->ido_11in;
        /*se ingresa la herramienta*/
        $model12->chr_10in = $chr_10in;
        $model12->can_12in = $can_12in;
        /*buscamos la herramienta que se esta agregando al carrito, para obtener el precio*/
        $her = Tr10her::findOne($chr_10in);
        /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
        $model12->pre_12de = $her['pre_10de'];
        $model12->mto_12de =  $her['pre_10de'] * $can_12in;
        /*se guarda el articulo en la tbl 12*/
        if($model12->save(false)){
          /* como la orden recien se esta creando, entonces el monto total de tr 11 es igual que el de tr12 porque solo tiene un articulo.
          actualizamos la orden recien guardada y le pasamos el subtotal y el monto total*/
          $model11->sto_11de = $model12->mto_12de;
          $model11->mto_11de = $model12->mto_12de;
          /*actualizamos el monto total de la orden con los nuevos datos*/
          if($model11->save(false)){
            /*se pone un mensaje de success*/
            $tran->commit();
            $res = ['ok'=>true,'msj'=>'<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Articulo agregado').'!</strong>'];
            echo json_encode($res);
            exit();
          }else{
            $tran->rollBack();
            $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','No se pudo crear la orden').'!</strong>'];
            echo json_encode($res);
            exit();
          }
        }else{/* fin if($model12->save()){*/
          /*se pone un mensaje de error*/
          $tran->rollBack();
          $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','Error al agregar articulo').'!</strong>
          <br />Por favor contactenos y comente lo sucedido'];
          echo json_encode($res);
          exit();
        }
      }else{ /*fin primer if($model11->save())*/
        $tran->rollBack();
        $res = ['ok'=>false,'msj'=>'<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se pudo guardar la orden').'!</strong>'];
        echo json_encode($res);
        exit();
      }
    } catch (\Exception $e) {
      $tran->rollBack();
      throw $e;
    }
  }



  // public function actionAgregarArticulo($id_orden){
  //   $model12 = new Tr12detalq();
  //   // $model11 = new Tr11ordAlq;
  //   if ($model12->load(Yii::$app->request->post())) {
  //     /*buscamos la orden con numero de cliente, ademas esta orden debe estar con estado 1 o 2 (Activo o Solicitado)*/
  //     $orden = Tr11ordAlq::find()->where($id_orden)->andWhere(['IN','est_11in',[1,2]])->one();
  //     if ($orden) {
  //       /*se busca en la tbl 12 donde el id orden sea == $id_orden, ademas donde el codigo herramienta se igual al seleccionado
  //       $model12->chr_10in, si se llega a este punto es que la orden esta activa, por lo tanto no se tiene que volver a validar.
  //        si todo esto se cumple, es que existe una orden activa para el cliente y
  //       la cantidad de esa herramienta se debe aumentar y no crear un nuevo articulo en tbl 12*/
  //       $articulo = Tr12detalq::findOne(['ido_11in'=>$id_orden,'chr_10in'=>$model12->chr_10in,]);
  //       /*si la herramienta ya esta en el carrito*/
  //       if($articulo){
  //         /*sumamos la cantidad actual con la ingresada*/
  //         $articulo->can_12in = $articulo->can_12in+$model12->can_12in;
  //         /*se vuelve a calcular el monto total
  //         monto total es = a la cantidad total de herramientas en este item * el precio que ya tiene la herramienta*/
  //         $articulo->mto_12de = $articulo->can_12in * $articulo->pre_12de;
  //         if($articulo->save()){
  //           /*si guardamos el articulo, entonces actualizamos el monto total de la orden
  //           se usa $orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
  //           $orden->sto_11de = $orden->sto_11de+$articulo->mto_12de;
  //           $orden->mto_11de = $orden->mto_11de+$articulo->mto_12de;
  //           if($orden->save()){
  //             /*se pone un mensaje de success y redirecciona a index*/
  //             Yii::$app->getSession()->setFlash('success',
  //               '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>');
  //             return $this->redirect(['index']);
  //           }else{
  //           /*se pone un mensaje de error y redirecciona a index*/
  //           Yii::$app->getSession()->setFlash('error',
  //             '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','$orden - No se incremento la cantidad de este articulo').'!</strong>');
  //           return $this->redirect(['index']);
  //           }
  //           // /*se pone un mensaje de success y redirecciona a index*/
  //           // Yii::$app->getSession()->setFlash('success',
  //           //   '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Se incremento la cantidad de este articulo').'!</strong>');
  //           // return $this->redirect(['index']);
  //           }else{
  //           /*se pone un mensaje de error y redirecciona a index*/
  //           Yii::$app->getSession()->setFlash('error',
  //             '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','$articulo - No se incremento la cantidad de este articulo').'!</strong>');
  //           return $this->redirect(['index']);
  //           }
  //       }
  //       /*se ingresa el id orden en model de tbl 12*/
  //       $model12->ido_11in = $orden['ido_11in'];
  //       /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
  //       $her = Tr10her::findOne($model12->chr_10in);
  //       /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
  //       $model12->pre_12de = $her['pre_10de'];
  //       $model12->mto_12de =  $model12->pre_12de * $model12->can_12in;
  //       if($model12->save()){
  //         /*si guardamos el articulo, entonces actualizamos el monto total de la orden
  //         se usa orden porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
  //         $orden->sto_11de = $orden->sto_11de+$model12->mto_12de;
  //         $orden->mto_11de = $orden->mto_11de+$model12->mto_12de;
  //         /*actualizamos la orden con los nuevos datos*/
  //         if($orden->save()){
  //           /*se pone un mensaje de success y redirecciona a index*/
  //           Yii::$app->getSession()->setFlash('success',
  //             '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Carrito Actualizado').'!</strong>');
  //           return $this->redirect(['index']);
  //         }else{
  //           /*se pone un mensaje de error y redirecciona a index*/
  //           Yii::$app->getSession()->setFlash('error',
  //             '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo actualizar la orden con los montos actualizados').'!</strong>');
  //           return $this->redirect(['index']);
  //         }
  //       }else{/* fin if($model12->save()){*/
  //         /*se pone un mensaje de error y redirecciona a index*/
  //         Yii::$app->getSession()->setFlash('error',
  //           '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo añadir el articulo al carrito').'!</strong>');
  //         return $this->redirect(['index']);
  //       }
  //     }else{ /* fin if ($m)*/
  //       Yii::$app->getSession()->setFlash('error',
  //         '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se puede agregar artículos a esta orden').'!</strong>');
  //       return $this->redirect(['index']);
  //     }
  //   }
  //
  //   if(Yii::$app->request->isAjax){
  //     return $this->renderAjax('formAgregarArticulo', [
  //         'model12' => $model12,
  //         // 'model11'=> $model11,
  //     ]);
  //   }else{
  //     return $this->render('formAgregarArticulo', [
  //         'model12' => $model12,
  //         // 'model11'=> $model11,
  //     ]);
  //   }
  //
  //
  // }
}
