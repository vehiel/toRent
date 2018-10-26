<?php

namespace app\controllers;

use Yii;
use app\models\Tr12detalq;
use app\models\Tr11ordAlq;
use app\models\Tr10her;
use app\models\search\Tr12detalqSearch;
use app\models\search\Tr11ordAlqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            'only'=>['index','view','update','create','delete'],
            'rules'=>[
              [
                'actions'=>['view','create','update','delete','index'],
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

        /*Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Guardado').'!</strong>');*/
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
    public function actionView($id)
    {

      $model11 = Tr11ordAlq::findOne($id);
      $searchModel = new Tr12detalqSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model11' => $model11,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        // $searchModel = new Tr11ordAlqSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Guardado').'!</strong>');*/
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
          $m = Tr11ordAlq::find()->where(['ncl_06in'=>$model11->ncl_06in])->andWhere(['IN','est_11in',[1,2]])->one();
          /*si se obtuvo la orden*/
          if ($m) {
            /*se ingresa el id orden en model de tbl 12*/
            $model12->ido_11in = $m['ido_11in'];
            /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
            $her = Tr10her::findOne($model12->chr_10in);
            /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
            $model12->pre_12de = $her['pre_10de'];
            $model12->mto_12de =  $model12->pre_12de * $model12->can_12in;
            if($model12->save()){
              /*si guardamos el articulo, entonces actualizamos el monto total de la orden
              se usa $m porque es el modelo guardado, si se utiliza $model11 creara una nueva orden*/
              $m->sto_11de = $m->sto_11de+$model12->mto_12de;
              $m->mto_11de = $m->mto_11de+$model12->mto_12de;
              /*actualizamos la orden con los nuevos datos*/
              if($m->save()){
                /*se pone un mensaje de success y redirecciona a index*/
                Yii::$app->getSession()->setFlash('success',
                  '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Carrito Actualizado').'!</strong>');
                return $this->redirect(['index']);
              }else{
                /*se pone un mensaje de error y redirecciona a index*/
                Yii::$app->getSession()->setFlash('error',
                  '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo actualizar la orden con los montos actualizados').'!</strong>');
                return $this->redirect(['index']);
              }
            }else{/* fin if($model12->save()){*/
              /*se pone un mensaje de error y redirecciona a index*/
              Yii::$app->getSession()->setFlash('error',
                '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo añadir el articulo al carrito').'!</strong>');
              return $this->redirect(['index']);
            }
          } /* fin if ($m)*/
/******************************************fin if orden existe, inicio creacion nueva orden************************************************************/

          /* si se llega a este punto es que el cliente no tiene ninguna orden activa, por lo tanto se procede a crear*/
          /*el estado es activo al principio*/
          $model11->est_11in = 1;
          /*se ingresa fecha solicitud de forma automatica*/
          $model11->fso_11dt = Date('Y/m/d H:i:s');
          /*guardamos la orden de alquiler en la tbl 11*/
          if($model11->save()){
            /*si se guarda entonces obtenemos el id que genero y se lo pasamos a model de la tbl 12*/
              $model12->ido_11in = $model11->ido_11in;
              /*buscamos la articulo que se esta agregando al carrito, para obtener el precio*/
              $her = Tr10her::findOne($model12->chr_10in);
              /*el precio del articulo en tbl 12 es = al precio de la herramienta*/
              $model12->pre_12de = $her['pre_10de'];
              $model12->mto_12de =  $model12->pre_12de * $model12->can_12in;
              /*se guarda el articulo en la tbl 12*/
              if($model12->save()){
                /* como la orden recien se esta creando, entonces el monto total de tr 11 es igual que el de tr12 porque solo tiene un articulo
                actualizamos el modelo de la tbl 11 recien guardado y le pasamos el subtotal y el monto total*/
                $model11->sto_11de = $model12->mto_12de;
                $model11->mto_11de = $model12->mto_12de;
                /*actualizamos el monto total de la orden con los nuevos datos*/
                if($model11->save()){
                  /*se pone un mensaje de success y redirecciona a index*/
                  Yii::$app->getSession()->setFlash('success',
		                '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Guardado').'!</strong>');
                  return $this->redirect(['index']);
                }else{
                  /*se pone un mensaje de error y redirecciona a index*/
                  Yii::$app->getSession()->setFlash('error',
                    '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo actualizar orden con monto total').'!</strong>');
                  return $this->redirect(['index']);
                }
              }else{/* fin if($model12->save()){*/
                /*se pone un mensaje de error y redirecciona a index*/
                Yii::$app->getSession()->setFlash('error',
                  '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo guardar el articulo').'!</strong>');
                return $this->redirect(['index']);
              }
          }else{ /*fin primer if($model11->save())*/
            Yii::$app->getSession()->setFlash('error',
              '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','No se pudo guardar la orden').'!</strong>');
            return $this->redirect(['index']);
          }
        }

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
        if($model11->est_11in != 1){ /*estado 1 => Activo, solo si esta activo se puede editar, en los demas estado no*/
          Yii::$app->getSession()->setFlash('error',
            '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.Yii::t('app','Esta orden no se puede editar').'!</strong>');
          return $this->redirect(['index']);
        }
        $model12 = Tr12detalq::findOne(['ido_11in'=>$model11->ido_11in]);

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
        /*si esta orden esta en un estado diferente de Activo (1), no se puede Inactivar*/
        if($model11->est_11in != 1){
          Yii::$app->getSession()->setFlash('error',
            '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
            Yii::t('app','No se pudo Inactivar esta orden').'!</strong>');
          return $this->redirect(['index']);
        }
        /*si se puede eliminar buscamos los modelos de tbl 12 que estan ligados a la orden a eliminar*/
        $model12 = Tr12detalq::find(['ido_11in'=>$id])->all();
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
}
