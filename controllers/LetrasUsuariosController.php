<?php

namespace app\controllers;

use Yii;
use app\models\LetraUsuario;
use app\models\LetraUsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LetrasUsuariosController implementa todas las acciones para el modelo de LetraUsuario.
 */
class LetrasUsuariosController extends Controller
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
                        'actions' => ['create', 'view'],
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
     * Lista todos los modelos de LetraUsuario.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LetraUsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo de LetraUsuario.
     * @param integer $id El id de la letra del usuario.
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo modelo de LetraUsuario.
     * Si la creación es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LetraUsuario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un modelo de LetraUsuario existente.
     * Si la actualización es satisfactoria, el usuario será redirigido a la vista del modelo.
     * @param integer $id El id de la letra del usuario.
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
     * Elimina un modelo de LetraUsuario existente.
     * Si la eliminación es satisfactoria, el usuario será redirigido al 'index'.
     * @param integer $id El id de la letra del usuario.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo de LetraUsuario basado en el valor de la clave primaria.
     * Si no se encuentra el modelo, se lanzara una excepción HTTP 404.
     * @param integer $id El id de la letra del usuario.
     * @return LetraUsuario El modelo cargado.
     * @throws NotFoundHttpException Si el modelo no puede encontrarse.
     */
    protected function findModel($id)
    {
        if (($model = LetraUsuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
