<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letras".
 *
 * @property integer $id
 * @property integer $id_cancion
 * @property integer $id_idioma
 * @property string $letra
 * @property boolean $bloqueada
 * @property string $created_at
 *
 * @property Canciones $idCancion
 * @property Idiomas $idIdioma
 * @property LetrasUsuarios[] $letrasUsuarios
 * @property VotosLetras[] $votosLetras
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
            'id_cancion' => 'Id Cancion',
            'id_idioma' => 'Id Idioma',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotosLetras()
    {
        return $this->hasMany(VotoLetra::className(), ['id_letra' => 'id'])->inverseOf('idLetra');
    }
}
