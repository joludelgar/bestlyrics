<?php

namespace app\controllers;

use Yii;
use app\models\Letra;
use app\models\Idioma;
use app\models\Cancion;
use app\models\LetraSearch;
use app\models\LetraUsuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * LetrasController implementa todas las acciones para el modelo de Letra.
 */
class LetrasController extends Controller
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
                        'actions' => ['create', 'update', 'ultimas'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['ultimas'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'ultimas', 'bloquear'],
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
     * Lista todos los modelos de Letra.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LetraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lista las ultimas letras creadas.
     * @return mixed
     */
    public function actionUltimas()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Letra::find()->orderBy('created_at desc'),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => false,
        ]);

        return $this->render('ultimas', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Muestra un modelo de Letra.
     * @param integer $id El id de la letra.
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo modelo de Letra.
     * Si es la primera letra de una canción, se modifica la canción indicando que es la letra original.
     * Al guardar el modelo se crea un nuevo modelo de LetraUsuario para indicar el usuario que ha creado la letra.
     * Si la creación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id de la canción asociado a la letra.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Letra();

        $model->id_cancion = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $cancion = Cancion::findOne($id);

            if ($cancion->id_letra_original == null) {
                $cancion->id_letra_original = $model->id;
                $cancion->save();
            }

            $modelLetraUsuario = new LetraUsuario();
            $modelLetraUsuario->id_letra = $model->id;
            $modelLetraUsuario->id_usuario = Yii::$app->user->identity->id;
            $modelLetraUsuario->save();

            return $this->redirect(['canciones/view', 'id' => $model->id_cancion]);
        } else {
            $idiomas = Idioma::find()->select('nombre, id')->indexBy('id')->column();
            return $this->render('create', [
                'model' => $model,
                'idiomas' => $idiomas,
            ]);
        }
    }

    /**
     * Modifica un modelo de Letra existente.
     * Al modificar y guardar el modelo se crea un nuevo modelo de LetraUsuario para indicar el usuario que ha modificado la letra.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id de la letra.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelLetraUsuario = new LetraUsuario();
            $modelLetraUsuario->id_letra = $id;
            $modelLetraUsuario->id_usuario = Yii::$app->user->identity->id;
            $modelLetraUsuario->save();

            return $this->redirect(['canciones/view', 'id' => $model->id_cancion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Bloquea la modificación de la letra a traves de AJAX.
     * @return boolean Devuelve true si la letra está bloqueada o false si no lo está.
     */
    public function actionBloquear()
    {
        $model = $this->findModel(Yii::$app->request->post('id'));

        if ($model->bloqueada) {
            $model->bloqueada = false;
        } else {
            $model->bloqueada = true;
        }

        $model->save();
        return $model->bloqueada;
    }

    /**
     * Elimina un modelo de Letra existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id de la letra.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo de Letra basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id de la letra.
     * @return Letra El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede encontrarse.
     */
    protected function findModel($id)
    {
        if (($model = Letra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
