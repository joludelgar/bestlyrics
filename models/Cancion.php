<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "canciones".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_album
 * @property integer $id_letra_original
 * @property string $nombre
 * @property string $video
 * @property string $created_at
 *
 * @property Albumes $idAlbum
 * @property User $idUsuario
 * @property Favoritos[] $favoritos
 * @property User[] $idUsuarios
 * @property Letras[] $letras
 * @property Idiomas[] $idIdiomas
 */
class Cancion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'canciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_album', 'id_letra_original'], 'integer'],
            [['nombre'], 'required'],
            [['created_at'], 'safe'],
            [['nombre', 'video'], 'string', 'max' => 255],
            [['id_album'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['id_album' => 'id']],
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
            'id_album' => 'Id Album',
            'id_letra_original' => 'Id Letra Original',
            'nombre' => 'Nombre',
            'video' => 'URL del video',
            'created_at' => 'Fecha creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'id_album'])->inverseOf('canciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('canciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['id_cancion' => 'id'])->inverseOf('idCancion');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getIdUsuarios()
    {
        return $this->hasMany(User::className(), ['id' => 'id_usuario'])->viaTable('favoritos', ['id_cancion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLetras()
    {
        return $this->hasMany(Letra::className(), ['id_cancion' => 'id'])->inverseOf('idCancion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLetraOriginal()
    {
        return Letra::findOne(['id' => $this->id_letra_original]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIdiomas()
    {
        return $this->hasMany(Idioma::className(), ['id' => 'id_idioma'])->viaTable('letras', ['id_cancion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraducciones()
    {
        $letras = $this->letras;
        return array_shift($letras);
    }
}
