<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "artistas".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $biografia
 * @property string $created_at
 *
 * @property Album[] $albumes
 * @property User $idUsuario
 */
class Artista extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'integer'],
            [['nombre'], 'required'],
            [['biografia'], 'string'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
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
            'nombre' => 'Nombre',
            'biografia' => 'Biografia',
            'created_at' => 'Fecha creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumes()
    {
        return $this->hasMany(Album::className(), ['id_artista' => 'id'])->inverseOf('idArtista');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('artistas');
    }

    /**
     * Devuelve la URl de la imagen o la URL de la imagen por defecto.
     * @return string
     */
    public function getImageUrl()
    {
        $uploads = Yii::getAlias('@artistas');
        if (file_exists("$uploads/{$this->id}.png")){
            return "/$uploads/{$this->id}.png";
        } elseif (file_exists("$uploads/{$this->id}.jpg")){
            return "/$uploads/{$this->id}.jpg";
        } else {
            return "/$uploads/example.jpg";
        }
    }
}
