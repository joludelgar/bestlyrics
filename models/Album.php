<?php

namespace app\models;

use Yii;

/**
 * Este es la modelo para la tabla "albumes".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_artista
 * @property integer $id_genero
 * @property string $nombre
 * @property string $anio
 * @property string $created_at
 *
 * @property Artista $idArtista
 * @property Genero $idGenero
 * @property User $idUsuario
 * @property Cancion[] $canciones
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
            [['id_usuario', 'id_artista', 'id_genero'], 'integer'],
            [['nombre', 'anio', 'id_genero'], 'required'],
            [['anio'], 'number'],
            ['anio','match', 'pattern' => '/^[12][0-9]{3}$/', 'message' => 'Año comprendido entre 1000 y 2999'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['id_artista'], 'exist', 'skipOnError' => true, 'targetClass' => Artista::className(), 'targetAttribute' => ['id_artista' => 'id']],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['id_genero' => 'id']],
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
            'id_genero' => 'Id Genero',
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
    public function getIdGenero()
    {
        return $this->hasOne(Genero::className(), ['id' => 'id_genero'])->inverseOf('albumes');
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
    public function getCanciones()
    {
        return $this->hasMany(Cancion::className(), ['id_album' => 'id'])->inverseOf('idAlbum');
    }

    /**
     * Devuelve la URl de la imagen o la URL de la imagen por defecto.
     * @return string
     */
    public function getImageUrl()
    {
        $uploads = Yii::getAlias('@albumes');
        if (file_exists("$uploads/{$this->id}.png")){
            return "/$uploads/{$this->id}.png";
        } elseif (file_exists("$uploads/{$this->id}.jpg")){
            return "/$uploads/{$this->id}.jpg";
        } else {
            return "/$uploads/disco.png";
        }
    }
}
