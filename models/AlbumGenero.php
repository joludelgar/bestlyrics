<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "albumes_generos".
 *
 * @property integer $id
 * @property integer $id_album
 * @property integer $id_genero
 *
 * @property Albumes $idAlbum
 * @property Generos $idGenero
 */
class AlbumGenero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'albumes_generos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_album', 'id_genero'], 'integer'],
            [['id_album'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['id_album' => 'id']],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['id_genero' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_album' => 'Id Album',
            'id_genero' => 'Id Genero',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'id_album'])->inverseOf('albumGeneros');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGenero()
    {
        return $this->hasOne(Genero::className(), ['id' => 'id_genero'])->inverseOf('albumGeneros');
    }
}
