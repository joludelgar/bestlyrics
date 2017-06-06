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
 * LetrasController implements the CRUD actions for Letra model.
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
     * Lists all Letra models.
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

    public function actionUltimas()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Letra::find()->orderBy('created_at desc'),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('ultimas', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Letra model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Letra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
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
     * Updates an existing Letra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Letra model.
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
     * Finds the Letra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Letra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
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
