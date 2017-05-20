<?php

namespace app\controllers;

use Yii;
use app\models\Artista;
use app\models\ArtistaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\models\UploadArtistaForm;
use yii\web\UploadedFile;

/**
 * ArtistasController implements the CRUD actions for Artista model.
 */
class ArtistasController extends Controller
{
    /**
     * @inheritdoc
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['ultimos', 'create', 'update', 'view'], // el index es provisional
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['ultimos', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'ultimos'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Artista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArtistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUltimos()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Artista::find()->orderBy('created_at desc'),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('ultimos', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Artista model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $upload = new UploadArtistaForm;

         if (Yii::$app->request->isPost) {
             $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
             $upload->upload($id);
         }

        $dataProvider = new ActiveDataProvider([
           'query' => Artista::findOne($id)->getAlbumes(),
           'pagination' => false,
           'sort' => false,
       ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'artistaForm' => $upload,
        ]);
    }

    /**
     * Creates a new Artista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artista();
        $model->id_usuario = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artista model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
