<?php
namespace app\controllers;

use Yii;
use app\models\Tr10her;
use app\models\search\Tr10herSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

date_default_timezone_set(Yii::$app->params['zonaHorario']);

/**
 * Tr10herController implements the CRUD actions for Tr10her model.
 */
class Tr10herController extends Controller
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
     * Lists all Tr10her models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Tr10herSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tr10her model.
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
     * Creates a new Tr10her model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tr10her();

        if ($model->load(Yii::$app->request->post())) {
          $model->alq_10in = 0;
          /*se crea una instancia del comprobante*/
          $model->file = UploadedFile::getInstance($model, 'file');
          /*si se ingreso un archivo y es fue valido*/
          if ($model->file) {
            /*se guarda el la ruta predeterminada*/
            if($model->file->saveAs('uploads/herramienta/' . $model->file->baseName . '.'. $model->file->extension)){
              /*si se guardo el comprobante, se agrega el nombre al modelo siendo guardado*/
              $model->ima_10vc = $model->file->baseName . '.' . $model->file->extension;
            }else{
              throw new ServerErrorHttpException(Yii::t('app', 'No se pudo subir el archivo'));
            }
            /*se pone null el atributo file para que no de problemas a la hora de guardar el modelo*/
            $model->file =null;
          }
          if($model->save()){
            return $this->redirect(['view', 'id' => $model->chr_10in]);
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tr10her model.
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
            si el archivo existe y ademas ima_10vc no esta null, se elimina el comprobante
            si no se comprueba ima_10vc la busqueda del file_exists sera true,
            porque el directorio si existe*/
            if(file_exists(Yii::getAlias('@app').'/web/uploads/herramienta/'.$model->ima_10vc)
            && $model->ima_10vc != null){
              unlink(Yii::getAlias('@app').'/web/uploads/herramienta/'.$model->ima_10vc);
            }
            /*se guarda el nuevo comprobante*/
            if($model->file->saveAs('uploads/herramienta/' . $model->file->baseName . '.'. $model->file->extension)){
              /*si se guardo el archivo, se agrega el nombre de comprobante al modelo aguardar*/
              $model->ima_10vc = $model->file->baseName . '.' . $model->file->extension;
            }
            /*se pone en null el atributo file, para que no de problemas al guardar*/
            $model->file =null;
          }
          if($model->save()){
            return $this->redirect(['view', 'id' => $model->chr_10in]);
          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tr10her model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      if($model->tr12detalqs == null){
        if(file_exists(Yii::getAlias('@app').'/web/uploads/herramienta/'.$model->ima_10vc)
        && $model->ima_10vc != null){
          unlink(Yii::getAlias('@app').'/web/uploads/herramienta/'.$model->ima_10vc);
        }
        if ($model->delete()) {
          Yii::$app->getSession()->setFlash('success',
          '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
          Yii::t('app','Nombre eliminado').'!</strong>');
          return $this->redirect(['index']);
        }else{
          Yii::$app->getSession()->setFlash('error',
          '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
          Yii::t('app','No se pudo eliminar').'!</strong>');
          return $this->redirect(['index']);
        }
      }else{
        Yii::$app->getSession()->setFlash('error',
        '<span class="glyphicon glyphicon-bullhorn"></span> <strong>'.
        Yii::t('app','No se puede eliminar').'!</strong>');
        return $this->redirect(['index']);
      }
    }

    /**
     * Finds the Tr10her model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tr10her the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tr10her::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /*muestra vista de herramienta con datos detallados desde catalogo*/
    public function actionMasInfo($id){
      if(Yii::$app->request->isAjax){
        return $this->renderAjax('masInfo', [
            'model' => $this->findModel($id),
        ]);
      }else{
        return $this->render('masInfo', [
            'model' => $this->findModel($id),
        ]);
      }

    }
}
