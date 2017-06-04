<?php

namespace app\controllers;

use Yii;
use app\models\Album;
use app\models\Genero;
use app\models\Reporte;
use app\models\AlbumSearch;
use app\models\UploadAlbumForm;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * AlbumesController implements the CRUD actions for Album model.
 */
class AlbumesController extends Controller
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
                        'actions' => ['create', 'update', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $upload = new UploadAlbumForm;

         if (Yii::$app->request->isPost) {
             $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
             $upload->upload($id);
         }

        $dataProvider = new ActiveDataProvider([
           'query' => Album::findOne($id)->getCanciones(),
           'pagination' => false,
           'sort' => false,
       ]);

       $render = null;

       if (!Yii::$app->user->isGuest) {
           $reporteModel = new Reporte();

           $reporteModel->id_reportador = Yii::$app->user->identity->id;
           $reporteModel->enlace = Yii::$app->request->absoluteUrl;

           if ($reporteModel->load(Yii::$app->request->post()) && $reporteModel->save()) {
               return $this->redirect(['view', 'id' => $id]);
           } else {
               $render = $this->renderPartial('/reportes/create', ['model' => $reporteModel]);
           }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'albumForm' => $upload,
            'render' => $render,
        ]);
    }

    /**
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Album();

        $model->id_usuario = Yii::$app->user->identity->id;
        $model->id_artista = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $generos = Genero::find()->select('nombre, id')->indexBy('id')->column();
            return $this->render('create', [
                'model' => $model,
                'generos' => $generos,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
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
     * Deletes an existing Album model.
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
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
