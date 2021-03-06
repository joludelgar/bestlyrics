<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\helpers\Html;
use Yii;

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
        $uploads = Yii::getAlias('@uploads');
        $avatar = glob($uploads . "/$this->id.*");
        $s3 = Yii::$app->get('s3');

        if (count($avatar) != 0) {
            $ruta = $avatar[0];
        } else {
            $ruta = $uploads . "/$this->id.jpg";
            if (!$s3->exist($ruta)) {
                $ruta = $uploads . "/$this->id.png";
            }
        }

        if (file_exists($ruta)) {
            return "/$ruta";
        } elseif ($s3->exist($ruta)) {
            $s3->commands()->get($ruta)->saveAs($ruta)->execute();
            return "/$ruta";
        } else {
            return "/$uploads/example.jpg";
        }
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
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['id' => 'id_usuario'])->inverseOf('idUsuario');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanciones()
    {
        return $this->hasMany(Cancion::className(), ['id' => 'id_usuario'])->inverseOf('idUsuario');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportes()
    {
        return $this->hasMany(Reporte::className(), ['id' => 'id_usuario'])->inverseOf('idReportador');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['id_usuario' => 'id'])->inverseOf('idUsuario');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLetrasUsuarios()
    {
        return $this->hasMany(LetraUsuario::className(), ['id_usuario' => 'id'])->inverseOf('idUsuario');
    }
}
