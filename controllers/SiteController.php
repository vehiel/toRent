<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\models\LoginForm;
use app\models\LoginFormCliente;
use app\models\ContactForm;
use app\models\Tr08nhr;
use app\models\Tr10her;
use app\models\Tr11ordAlq;
use app\models\search\Tr12detalqSearch;

date_default_timezone_set(Yii::$app->params['zonaHorario']);

class SiteController extends Controller
{
  /**
  * {@inheritdoc}
  */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  /**
  * Displays homepage.
  *
  * @return string
  */
  public function actionIndex()
  {
    // Yii::$app->language = 'es';
    //
    // $languageCookie = new \yii\web\Cookie([
    //   'name' => 'language',
    //   'value' => 'es',
    //   'expire' => time() + 60 * 60 * 24 * 30, // 30 days
    // ]);
    // Yii::$app->response->cookies->add($languageCookie);
    return $this->render('index');
  }

  /**
  * Login action.
  *
  * @return Response|string
  */
  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      // if(isset(Yii::$app->user->identity->idp_02in)){
      //   echo '<script>console.log("idp_02in: '.Yii::$app->user->identity->idp_02in.'");</script>';
      // }else{
      //     echo '<script>console.log("idp_02in: no existes");</script>';
      // }
      // if (Yii::$app->user->isGuest) {
      //   echo '<script>console.log("el un pinche invitado");</script>';
      // }else{
      //   echo '<script>console.log("esta registrado");</script>';
      // }
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  public function actionLoginCliente()
  {
    if (!Yii::$app->userCliente->isGuest) {
      return $this->goHome();
    }

    $model = new LoginFormCliente();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('loginCliente', [
      'model' => $model,
    ]);
  }
  /**
  * Logout action.
  *
  * @return Response
  */
  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }
  public function actionLogoutCliente()
  {
    Yii::$app->userCliente->logout();

    return $this->goHome();
  }

  /**
  * Displays contact page.
  *
  * @return Response|string
  */
  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
  * Displays about page.
  *
  * @return string
  */
  public function actionAbout()
  {
    return $this->render('about');
  }

  public function actionCatalogo(){
    $var = Tr08nhr::find()->select(
      [
        'tr08nhr.idn_08in',
        'tr08nhr.ima_08vc',
        'nom_08vc',
        'h.pre_10de',
        // 'h.ima_10vc'
      ]
      )->innerJoin(['h'=>'tr10her'],'tr08nhr.idn_08in = h.idn_08in')->asArray()->all();
    return $this->render('catalogo',['var'=>$var]);
  }

  public function actionHerramienta($id){
    // $var = Tr08nhr::find()->select(
    //   [
    //     'h.idn_08in',
    //     // 'tr08nhr.ima_08vc',
    //     'nom_08vc',
    //     'm.nom_09vc',
    //     'h.cgm_09in',
    //     'h.pre_10de',
    //     'h.ima_10vc',
    //     'h.chr_10in'
    //   ]
    //   )
    //   ->innerJoin(['h'=>'tr10her'],'tr08nhr.idn_08in = h.idn_08in')
    //   ->innerJoin(['m'=>'tr09mar'],'m.cgm_09in = h.cgm_09in')
    //   ->andWhere(['h.idn_08in'=>$id])->groupBy('chr_10in')
    //   ->asArray()->all();
    $var = Tr10her::find()->select(
      [
            'tr10her.cgm_09in',
            'tr10her.pre_10de',
            'tr10her.ima_10vc',
            'tr10her.chr_10in',
            'tr10her.idn_08in',
            'tr08nhr.nom_08vc',
            'tr09mar.nom_09vc',
      ]
      )->innerJoin('tr08nhr','tr08nhr.idn_08in = tr10her.idn_08in')
      ->innerJoin('tr09mar','tr09mar.cgm_09in = tr10her.cgm_09in')
      ->where(['tr08nhr.idn_08in'=>$id])->asArray()->all();
      // var_dump($var);
      $nombre = Tr08nhr::findOne(['idn_08in'=>$id]);
    return $this->render('herramienta',['var'=>$var,'titulo'=>$nombre['nom_08vc']]);
  }

  public function actionCarrito(){
    // $model11 = Tr11ordAlq::findOne(['ncl_06in'=>Yii::$app->userCliente->identity->ncl_06in]);
    $model11 = Tr11ordAlq::findOne(['ncl_06in'=>Yii::$app->userCliente->identity->ncl_06in,'est_11in'=>[1,2]]);
    /*eliminar*/
    $alertBlock = true;
    if ($model11 == null) {
      Yii::$app->getSession()->setFlash('success',
      '<span class="glyphicon glyphicon-ok-sign"></span> <strong>'.
      Yii::t('app','No tiene articulos en el carrito').'!</strong>');
      return $this->redirect(['catalogo']);
    }

    $searchModel = new Tr12detalqSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$model11->ido_11in);
    return $this->render('carrito', [
      'model11' => $model11,
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'showAlertBlock'=>$alertBlock,
    ]);
  }
}
