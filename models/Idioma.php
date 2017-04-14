<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "idiomas".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Letras[] $letras
 * @property Canciones[] $idCancions
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
