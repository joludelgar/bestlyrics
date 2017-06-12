<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "letras".
 *
 * @property integer $id
 * @property integer $id_cancion
 * @property integer $id_idioma
 * @property string $letra
 * @property boolean $bloqueada
 * @property string $created_at
 *
 * @property Cancion $idCancion
 * @property Idioma $idIdioma
 * @property LetraUsuario[] $letrasUsuarios
 */
class Letra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cancion', 'id_idioma'], 'integer'],
            [['letra', 'id_idioma'], 'required'],
            [['letra'], 'string'],
            [['bloqueada'], 'boolean'],
            [['created_at'], 'safe'],
            [['id_cancion', 'id_idioma'], 'unique', 'targetAttribute' => ['id_cancion', 'id_idioma'], 'message' => 'The combination of Id Cancion and Id Idioma has already been taken.'],
            [['id_cancion'], 'exist', 'skipOnError' => true, 'targetClass' => Cancion::className(), 'targetAttribute' => ['id_cancion' => 'id']],
            [['id_idioma'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::className(), 'targetAttribute' => ['id_idioma' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cancion' => 'Cancion',
            'id_idioma' => 'Idioma',
            'letra' => 'Letra',
            'bloqueada' => 'Bloqueada',
            'created_at' => 'Fecha creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCancion()
    {
        return $this->hasOne(Cancion::className(), ['id' => 'id_cancion'])->inverseOf('letras');
    }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getIdIdioma()
   {
       return $this->hasOne(Idioma::className(), ['id' => 'id_idioma'])->inverseOf('letras');
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLetrasUsuarios()
    {
        return $this->hasMany(LetraUsuario::className(), ['id_letra' => 'id'])->inverseOf('idLetra');
    }
}
