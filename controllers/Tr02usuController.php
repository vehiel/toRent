<?php
namespace app\controllers;

use Yii;
use app\models\Tr02usu;
use app\models\search\Tr02usuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


date_default_timezone_set(Yii::$app->params['zonaHorario']);

/**
* Tr02usuController implements the CRUD actions for Tr02usu model.
*/
class Tr02usuController extends Controller
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
  * Lists all Tr02usu models.
  * @return mixed
  */
  public function actionIndex()
  {
    $searchModel = new Tr02usuSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single Tr02usu model.
  * @param integer $nus_02in
  * @param integer $idp_02in
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionView($nus_02in, $idp_02in)
  {
    $model = $this->findModel($nus_02in, $idp_02in);
    if($model->fna_02dt != null){
      $model->fna_02dt = date('d-m-Y', strtotime($model->fna_02dt));
    }
    return $this->render('view', [
      'model' => $model,
    ]);
  }

  /**
  * Creates a new Tr02usu model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate()
  {
    $model = new Tr02usu();

    if ($model->load(Yii::$app->request->post())) {
      $model->fna_02dt = date('Y-m-d', strtotime($model->fna_02dt));
      $model->con_02vc = Yii::$app->security->generatePasswordHash($model->con_02vc);
      if($model->save()){
        return $this->redirect(['view', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in]);
      }
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
  * Updates an existing Tr02usu model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $nus_02in
  * @param integer $idp_02in
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionUpdate($nus_02in, $idp_02in)
  {
    $model = $this->findModel($nus_02in, $idp_02in);

    if ($model->load(Yii::$app->request->post())) {
      $model->fna_02dt = date('Y-m-d', strtotime($model->fna_02dt));
      if($model->save()){
        return $this->redirect(['view', 'nus_02in' => $model->nus_02in, 'idp_02in' => $model->idp_02in]);
      }
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
  * Deletes an existing Tr02usu model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $nus_02in
  * @param integer $idp_02in
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionDelete($nus_02in, $idp_02in)
  {
    $model = $this->findModel($nus_02in, $idp_02in);
    $model->est_02in = 0;
    if ($model->save()) {
      Yii::$app->getSession()->setFlash('success',
      '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.Yii::t('app','Usuario inactivo').'!</strong>');
      return $this->redirect(['index']);
    }else{
      Yii::$app->getSession()->setFlash('error',
      '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
      Yii::t('app','No se puede inactivar').'!</strong>');
      return $this->redirect(['index']);
    }
  }

  /**
  * Finds the Tr02usu model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $nus_02in
  * @param integer $idp_02in
  * @return Tr02usu the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($nus_02in, $idp_02in)
  {
    if (($model = Tr02usu::findOne(['nus_02in' => $nus_02in, 'idp_02in' => $idp_02in])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }
}
