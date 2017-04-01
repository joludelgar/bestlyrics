<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "canciones".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_album
 * @property string $nombre
 * @property string $video
 * @property string $created_at
 *
 * @property Albumes $idAlbum
 * @property User $idUsuario
 * @property Favoritos[] $favoritos
 * @property Letras[] $letras
 * @property Traducciones[] $traducciones
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
            [['id_usuario', 'id_album'], 'integer'],
            [['nombre'], 'required'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['video'], 'string', 'max' => 11],
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
            'nombre' => 'Nombre',
            'video' => 'Video',
            'created_at' => 'Created At',
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
        return $this->hasMany(Favoritos::className(), ['id_cancion' => 'id'])->inverseOf('idCancion');
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
    public function getTraducciones()
    {
        return $this->hasMany(Traduccion::className(), ['id_cancion' => 'id'])->inverseOf('idCancion');
    }
}
