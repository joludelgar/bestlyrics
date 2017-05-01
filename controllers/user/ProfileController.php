<?php
namespace app\controllers\user;
use dektrium\user\controllers\ProfileController as BaseProfileController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\CommentModel;
use yii\filters\AccessControl;
use app\models\User;
use Yii;
class ProfileController extends BaseProfileController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['index'], 'roles' => ['@']],
                    ['allow' => true, 'actions' => ['show', 'votados', 'comentarios'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }
    /**
     * Muestra el perfil del usuario con los posts subidos y aprobados
     *
     * @param string $username
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

        $dataProvider = new ActiveDataProvider([
            'query' => User::findOne($id)->getFavoritos(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }


        return $this->render('show', [
            'profile' => $profile,
            'dataProvider' => $dataProvider,
        ]);
    }
}
