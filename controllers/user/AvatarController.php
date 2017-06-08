<?php

namespace app\controllers\user;
use dektrium\user\controllers\SettingsController as BaseSettingController;
use app\models\AvatarForm;
use dektrium\user\models\Profile;
use dektrium\user\models\SettingsForm;
/**
 * AvatarController controla las actualizaciones de la configuración del usuario (Ej: perfil, avatar, email y contraseña).
 */
class AvatarController extends BaseSettingController
{
    /**
     * Muestra el formulario de configuración del perfil.
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        $model = $this->finder->findProfileById(\Yii::$app->user->identity->getId());
        if ($model == null) {
            $model = \Yii::createObject(Profile::className());
            $model->link('user', \Yii::$app->user->identity);
        }
        $event = $this->getProfileEvent($model);
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your profile has been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    /**
     * Muestra una página donde el usuario puede actualizar su configuración de la cuenta (nombre de usuario, avatar, email o contraseña).
     *
     * @return string|\yii\web\Response
     */
    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($model);
        $avatar = $this->finder->findProfileById(\Yii::$app->user->identity->getId());
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('account', [
            'model' => $model,
            'avatar' => $avatar,
        ]);
    }
}
