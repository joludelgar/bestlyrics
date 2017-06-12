<?php

namespace app\controllers;

use Yii;
use app\models\Artista;
use app\models\ArtistaSearch;
use app\models\Reporte;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\models\UploadArtistaForm;
use yii\web\UploadedFile;

/**
 * ArtistasController implementa las acciones para el modelo de Artista.
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'ultimos', 'delete-imagen'],
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
     * Lista todos los modelos de Artista.
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

    /**
     * Lista los ultimos artistas añadidos.
     * @return mixed
     */
    public function actionUltimos()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Artista::find()->orderBy('created_at desc'),
            'pagination' => [
        	    'pagesize' => 10,
            ],
            'sort' => false,
        ]);

        return $this->render('ultimos', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Muestra un modelo de Artista. Tambien se muestra los albumes asociados al artista.
     * Si el usuario activo de la aplicación está registrado se muestra el modelo de Reporte.
     * @param integer $id El id del artista.
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
           'pagination' => [
        	    'pagesize' => 6,
            ],
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
            'artistaForm' => $upload,
            'render' => $render,
        ]);
    }

    /**
     * Crea un nuevo modelo de Artista.
     * Si la creación es satisfactoria, el usuario será redirigido a la vista del modelo.
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
     * Modifica un modelo de Artista existente.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del artista.
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
     * Elimina un modelo de Artista existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id del artista.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Elimina un la imagen del modelo de Artista seleccionado.
     * Si la eliminación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del artista.
     * @return mixed
     */
    public function actionDeleteImagen($id)
    {
        $imagenes = glob(Yii::getAlias('@artistas/') . "$id.*");

        $s3 = Yii::$app->get('s3');
        foreach ($imagenes as $imagen) {
            unlink($imagen);
            if ($s3->exist($imagen)) {
                $s3->delete($imagen);
            }
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Busca el modelo de Artista basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id del artista.
     * @return Artista El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede ser encontrado.
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
