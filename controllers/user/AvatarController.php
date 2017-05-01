<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 namespace app\controllers\user;
use dektrium\user\controllers\SettingsController as BaseSettingController;
use app\models\AvatarForm;
use dektrium\user\models\Profile;
use dektrium\user\models\SettingsForm;
/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class AvatarController extends BaseSettingController
{
    /**
     * Shows profile settings form.
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
     * Displays page where user can update account settings (username, email or password).
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
