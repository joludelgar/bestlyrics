<?php

namespace app\controllers;

use Yii;
use app\models\Favorito;
use app\models\FavoritoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FavoritosController implementa las acciones del modelo Favorito.
 */
class FavoritosController extends Controller
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
                        'actions' => ['create'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'delete'],
                        'roles' => ['@'],
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
     * Lista todos los modelos de Favorito.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FavoritoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo de Favorito.
     * @param integer $id El id de favorito.
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea y elimina un modelo de Favorito a traves de AJAX.
     * Si la creación o la eliminación es satisfactoria, se enviará un array en formato JSON.
     * Si el usuario no ha iniciado sesión se redirige a la página de login.
     * @return string Se devuelve un array en formato JSON con un booleano y el contador de favoritos de la canción.
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/login']);
        }

        $model = new Favorito();

        $model->id_cancion = Yii::$app->request->post('id');
        $model->id_usuario = Yii::$app->user->identity->id;

        if (!Favorito::findOne(['id_cancion' => $model->id_cancion, 'id_usuario' => $model->id_usuario])) {
            $model->save();
            return json_encode([true, count(Favorito::findAll(['id_cancion' => $model->id_cancion]))]);
        } else {
            $model = Favorito::findOne(['id_cancion' => $model->id_cancion, 'id_usuario' => $model->id_usuario]);
            $model->delete();
            return json_encode([false, count(Favorito::findAll(['id_cancion' => $model->id_cancion]))]);
        }
    }

    /**
     * Modifica un modelo de Favorito existente.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id del favorito.
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
     * Elimina un modelo de Favorito existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id del favorito.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo de Favorito basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id del favorito.
     * @return Favorito El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede ser encontrado.
     */
    protected function findModel($id)
    {
        if (($model = Favorito::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
