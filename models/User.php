<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\helpers\Html;

class User extends BaseUser
{
    /** Devuleve las noticias de un usuario identificado por id
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasOne(Noticia::className(), ['id_usuario' => 'id'])->inverseOf('usuarios');
    }
    /**Devuleve el nombre de  usuario identificado segun id
     * @return \yii\db\ActiveQuery
     */
    public function getUsername()
    {
        return Html::a($this->username, ['/user/profile/show', 'id' => $this->id], ['class' => 'profile-link']);
    }
    /**Devuleve el avatar de un usuario identificado por id
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        $uploads = \Yii::getAlias('@uploads');
        $ruta = "$uploads/{$this->id}.png";
        return file_exists($ruta) ? "/$ruta" : "/$uploads/default.png";
    }
}
