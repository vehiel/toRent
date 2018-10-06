<?php

namespace app\controllers;

use Yii;
use app\models\Tr06cli;
use app\models\search\Tr06cliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Tr06cliController implements the CRUD actions for Tr06cli model.
 */
class Tr06cliController extends Controller
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
     * Lists all Tr06cli models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Tr06cliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tr06cli model.
     * @param integer $idp_06in
     * @param integer $ncl_06in
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idp_06in, $ncl_06in)
    {
      $model = $this->findModel($idp_06in, $ncl_06in);
      $model->fna_06dt = date('d-m-Y', strtotime($model->fna_06dt));
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Tr06cli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tr06cli();

        if ($model->load(Yii::$app->request->post())) {
          $model->fna_06dt = date('Y-m-d', strtotime($model->fna_06dt));
          $model->con_06vc = Yii::$app->security->generatePasswordHash($model->con_06vc);
          if($model->save()){
            return $this->redirect(['view', 'idp_06in' => $model->idp_06in, 'ncl_06in' => $model->ncl_06in]);
          }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tr06cli model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idp_06in
     * @param integer $ncl_06in
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idp_06in, $ncl_06in)
    {
        $model = $this->findModel($idp_06in, $ncl_06in);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idp_06in' => $model->idp_06in, 'ncl_06in' => $model->ncl_06in]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tr06cli model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idp_06in
     * @param integer $ncl_06in
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idp_06in, $ncl_06in)
    {
        $this->findModel($idp_06in, $ncl_06in)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tr06cli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idp_06in
     * @param integer $ncl_06in
     * @return Tr06cli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idp_06in, $ncl_06in)
    {
        if (($model = Tr06cli::findOne(['idp_06in' => $idp_06in, 'ncl_06in' => $ncl_06in])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
