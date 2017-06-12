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
 * AlbumesController implementa las acciones para el modelo de Álbum.
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'delete-imagen'],
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
     * Lista todos los modelos de Álbum.
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
     * Muestra un modelo de Álbum junto con las canciones que pertenecen al álbum.
     * Si el usuario activo de la aplicación está registrado se muestra el modelo de Reporte.
     * @param integer $id El id del álbum.
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
           'query' => Album::findOne($id)->getCanciones()->orderBy('created_at'),
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
     * Crea un nuevo modelo de Álbum.
     * Si la creación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del artista asociado al álbum.
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
     * Actualiza un modelo de Álbum existente.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del álbum.
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
     * Elimina un modelo de Álbum existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id del álbum.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Elimina un la imagen del modelo de Album seleccionado.
     * Si la eliminación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del álbum.
     * @return mixed
     */
    public function actionDeleteImagen($id)
    {
        $imagenes = glob(Yii::getAlias('@albumes/') . "$id.*");

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
     * Busca el modelo de Álbum basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id del álbum.
     * @return Album El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede ser encontrado.
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
