<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generos".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property AlbumesGeneros[] $albumesGeneros
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumesGeneros()
    {
        return $this->hasMany(AlbumGenero::className(), ['id_genero' => 'id'])->inverseOf('idGenero');
    }
}
