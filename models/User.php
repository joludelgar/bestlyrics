<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\helpers\Html;

class User extends BaseUser
{
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
        return file_exists($ruta) ? "/$ruta" : "/$uploads/example.jpg";
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtistas()
    {
        return $this->hasMany(Artista::className(), ['id' => 'id_usuario'])->inverseOf('idUsuario');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['id_usuario' => 'id'])->inverseOf('idUsuario');
    }
}
