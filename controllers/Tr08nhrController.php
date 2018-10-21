<?php

namespace app\controllers;

use Yii;
use app\models\Tr08nhr;
use app\models\search\Tr08nhrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
* Tr08nhrController implements the CRUD actions for Tr08nhr model.
*/

class Tr08nhrController extends \yii\web\Controller
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
  * Lists all Tr09mar models.
  * @return mixed
  */
  public function actionIndex()
  {
    $searchModel = new Tr08nhrSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single Tr08nhr model.
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
  * Creates a new Tr08nhr model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate()
  {
    $model = new Tr08nhr();

    if ($model->load(Yii::$app->request->post())) {

      /*se crea una instancia del comprobante*/
      $model->file = UploadedFile::getInstance($model, 'file');
      /*si se ingreso un archivo y es fue valido*/
      if ($model->file) {
        /*se guarda el la ruta predeterminada*/
        if($model->file->saveAs('uploads/lh/' . $model->file->baseName . '.'. $model->file->extension)){
          /*si se guardo el comprobante, se agrega el nombre al modelo siendo guardado*/
          $model->ima_08vc = $model->file->baseName . '.' . $model->file->extension;
        }else{
          throw new ServerErrorHttpException(Yii::t('app', 'No se pudo subir el archivo'));
        }
        /*se pone null el atributo file para que no de problemas a la hora de guardar el modelo*/
        $model->file =null;
      }
      if($model->save()){
        return $this->redirect(['view', 'id' => $model->idn_08in]);
      }
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
  * Updates an existing Tr08nhr model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $id
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {

      $model->file = UploadedFile::getInstance($model, 'file');
      /*si existe el archivo, que el campo no este vacio, la vista previa no cuenta, el comprobante fue Eliminado y
      se cargo otro
      Cuando se muestra el formulario en update, carga una vista previa del comprobante,
      no carga el archivo, si el comprobante no se toca, no se actualizara*/
      if ($model->file) {
        /*si se cargo un nuevo comprobante, se comprueba que se elimine cualquier
        comprobante anterior
        si el archivo existe y ademas ima_08vc no esta null, se elimina el comprobante
        si no se comprueba ima_08vc la busqueda del file_exists sera true,
        porque el directorio si existe*/
        if(file_exists(Yii::getAlias('@app').'/web/uploads/lh/'.$model->ima_08vc)
        && $model->ima_08vc != null){
          unlink(Yii::getAlias('@app').'/web/uploads/lh/'.$model->ima_08vc);
        }
        /*se guarda el nuevo comprobante*/
        if($model->file->saveAs('uploads/lh/' . $model->file->baseName . '.'. $model->file->extension)){
          /*si se guardo el archivo, se agrega el nombre de comprobante al modelo aguardar*/
          $model->ima_08vc = $model->file->baseName . '.' . $model->file->extension;
        }
        /*se pone en null el atributo file, para que no de problemas al guardar*/
        $model->file =null;
      }
      if($model->save()){
        return $this->redirect(['view', 'id' => $model->idn_08in]);
      }
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
  * Deletes an existing Tr08nhr model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $id
  * @return mixed
  * @throws NotFoundHttpException if the model cannot be found
  */
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    if(file_exists(Yii::getAlias('@app').'/web/uploads/lh/'.$model->ima_08vc)
    && $model->ima_08vc != null){
      unlink(Yii::getAlias('@app').'/web/uploads/lh/'.$model->ima_08vc);
    }
    $model->delete();

    return $this->redirect(['index']);
  }

  /**
  * Finds the Tr08nhr model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $id
  * @return Tr08nhr the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = Tr08nhr::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }

}
