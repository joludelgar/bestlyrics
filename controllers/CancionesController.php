<?php

namespace app\controllers;

use Yii;
use app\models\Cancion;
use app\models\Album;
use app\models\CancionSearch;
use app\models\Reporte;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * CancionesController implementa las acciones para el modelo de Cancion.
 */
class CancionesController extends Controller
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
                        'actions' => ['create', 'update', 'view', 'video', 'top', 'full'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'top', 'full'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'video', 'top', 'full'],
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
     * Lista todos los modelos de Cancion.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CancionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lista los modelos de Cancion que obtienen más favoritos durante el mes actual.
     * @return mixed
     */
    public function actionTop()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cancion::findBySql('select * from top_mensual'),
            'pagination' => [
        	    'pagesize' => 10,
            ],
            'sort' => false,
        ]);

        return $this->render('top', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo de Cancion.
     * Si el usuario activo de la aplicación está registrado se muestra el modelo de Reporte.
     * @param integer $id El id de la canción.
     * @return mixed
     */
    public function actionView($id)
    {
        $cancion = Cancion::findOne($id);

        $dataProvider = new ActiveDataProvider([
            'query' => Album::find(['id' => $cancion->idAlbum->id]),
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
            'render' => $render,
        ]);
    }

    /**
     * Muestra una vista especial con un video de Youtube y la letra original.
     * @param integer $id El id de la canción.
     * @return mixed
     */
    public function actionFull($id)
    {
        return $this->render('viewFull', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo modelo de Cancion.
     * Si la creación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del álbum asociado a la canción.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Cancion();

        $model->id_usuario = Yii::$app->user->identity->id;
        $model->id_album = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['albumes/view', 'id' => $model->id_album]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un modelo de Cancion existente.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id de la canción.
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
     * Actualiza el modelo de Cancion añadiendo la URL del video.
     * @param  integer $id El id de la canción.
     * @return mixed
     */
    public function actionVideo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updateVideo', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Elimina un modelo de Cancion existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id de la canción.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo de Cancion basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id de la canción.
     * @return Cancion El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede encontrarse.
     */
    protected function findModel($id)
    {
        if (($model = Cancion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
