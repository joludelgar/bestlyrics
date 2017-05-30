<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Letra;
use app\models\Cancion;
use app\models\Album;
use app\models\Artista;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'admin'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        },
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
     * @inheritdoc
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
        $dataProvider = new ActiveDataProvider([
            'query' => Letra::find()->orderBy('created_at desc')->limit(6),
            'pagination' => false,
            'sort' => false,
        ]);

        $dataProvider2 = new ActiveDataProvider([
            'query' => Cancion::findBySql('select * from top_mensual')->limit(6),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
        ]);
    }


    public function actionCanciones($q = null)
    {
        if ($q !== null && $q !== '') {

            $canciones = Cancion::find()->select('*')->where(['ilike', 'nombre', $q])->all();

            $json = [];
            foreach ($canciones as $cancion) {
                $json[] = [
                    'id' => $cancion->id,
                    'nombre' => $cancion->nombre,
                    'artista' => $cancion->idAlbum->idArtista->nombre,
                    'artistaId' => $cancion->idAlbum->idArtista->id,
                ];
            }
            return json_encode($json);
        }
    }


    public function actionArtistas($q = null)
    {
        if ($q !== null && $q !== '') {

            $artistas = Artista::find()->select('*')->where(['ilike', 'nombre', $q])->all();

            $json = [];
            foreach ($artistas as $artista) {
                $json[] = [
                    'id' => $artista->id,
                    'nombre' => $artista->nombre,
                    'cover' => $artista->getImageUrl(),
                ];
            }
            return json_encode($json);
        }
    }


    public function actionAlbumes($q = null)
    {
        if ($q !== null && $q !== '') {

            $albumes = Album::find()->select('*')->where(['ilike', 'nombre', $q])->all();

            $json = [];
            foreach ($albumes as $album) {
                $json[] = [
                    'id' => $album->id,
                    'nombre' => $album->nombre,
                    'cover' => $album->getImageUrl(),
                    'artista' => $album->idArtista->nombre,
                    'artistaId' => $album->idArtista->id,
                ];
            }
            return json_encode($json);
        }
    }

    public function actionSearch($q = null)
    {
        if ($q !== null && $q !== '') {

            $cancionesProvider = new ActiveDataProvider([
                'query' => Cancion::find()->where(['ilike', 'nombre', $q]),
            ]);
            $artistasProvider = new ActiveDataProvider([
                'query' => Artista::find()->where(['ilike', 'nombre', $q]),
            ]);
            $albumesProvider = new ActiveDataProvider([
                'query' => Album::find()->where(['ilike', 'nombre', $q]),
            ]);

            return $this->render('search', [
                'q' => $q,
                'cancionesProvider' => $cancionesProvider,
                'artistasProvider' => $artistasProvider,
                'albumesProvider' => $albumesProvider,
            ]);
        }

        return $this->refresh();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAdmin()
    {
        return $this->render('admin');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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
}
