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
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($model11->load(Yii::$app->request->post()) && $model12->load(Yii::$app->request->post())) {
          /*el estado es activo al principio*/
          $model11->est_11in = 1;
          $model11->fso_11dt = Date('Y/m/d H:i:s');
          /*guardamos la orden de alquiler en la tbl 11*/
          if($model11->save()){
            /*si se guarda entonces obtenemos el id que genero y se lo pasamos a model de la tbl 12*/
              $model12->ido_11in = $model11->ido_11in;
              $her = Tr10her::findOne($model12->chr_10in);
              $model12->pre_12de = $her['pre_10de'];
              $model12->mto_12de =  $model12->pre_12de * $model12->can_12in;
              /*si guardamos detalle en la tbl 12*/
              if($model12->save()){
                /*si se guardo actualizamos el modelo de la tbl 11 recien guardado y le pasamos el subtotal y el monto total*/
                $model11->sto_11de = $model12->mto_12de;
                $model11->mto_11de = $model12->mto_12de;
                /*actualizamos la orden con los nuevos datos*/
                if($model11->save()){
                  return $this->redirect(['view', 'id' => $model12->idd_12in]);
                }else{
                  $this->redirect(['usuario/index']);
                }
              }
          }else{
            $this->redirect(['site/index']);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idd_12in]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

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
