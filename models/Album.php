<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "albumes".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_artista
 * @property string $nombre
 * @property string $anio
 * @property string $created_at
 *
 * @property Artistas $idArtista
 * @property User $idUsuario
 * @property AlbumesGeneros[] $albumesGeneros
 * @property Canciones[] $canciones
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'albumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_artista'], 'integer'],
            [['nombre', 'anio'], 'required'],
            [['anio'], 'number'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['id_artista'], 'exist', 'skipOnError' => true, 'targetClass' => Artista::className(), 'targetAttribute' => ['id_artista' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_artista' => 'Id Artista',
            'nombre' => 'Nombre',
            'anio' => 'Año',
            'created_at' => 'Fecha creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArtista()
    {
        return $this->hasOne(Artista::className(), ['id' => 'id_artista'])->inverseOf('albumes');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('albums');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumesGeneros()
    {
        return $this->hasMany(AlbumGenero::className(), ['id_album' => 'id'])->inverseOf('idAlbum');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanciones()
    {
        return $this->hasMany(Cancion::className(), ['id_album' => 'id'])->inverseOf('idAlbum');
    }
}
