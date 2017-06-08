<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "idiomas".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Letra[] $letras
 * @property Cancion[] $idCancions
 */
class Idioma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'idiomas';
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
    public function getLetras()
    {
        return $this->hasMany(Letra::className(), ['id_idioma' => 'id'])->inverseOf('idIdioma');
    }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getIdCancion()
   {
       return $this->hasMany(Cancion::className(), ['id' => 'id_cancion'])->viaTable('letras', ['id_idioma' => 'id']);
   }
}
