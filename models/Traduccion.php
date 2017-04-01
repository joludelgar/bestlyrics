<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "traducciones".
 *
 * @property integer $id
 * @property integer $id_cancion
 * @property integer $id_idioma
 * @property boolean $bloqueada
 * @property string $letra
 * @property string $created_at
 *
 * @property Canciones $idCancion
 * @property Idiomas $idIdioma
 * @property TraduccionesUsuarios[] $traduccionesUsuarios
 * @property VotosTraducciones[] $votosTraducciones
 */
class Traduccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'traducciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cancion', 'id_idioma'], 'integer'],
            [['bloqueada'], 'boolean'],
            [['letra'], 'required'],
            [['created_at'], 'safe'],
            [['letra'], 'string', 'max' => 5000],
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
            'bloqueada' => 'Bloqueada',
            'letra' => 'Letra',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCancion()
    {
        return $this->hasOne(Cancion::className(), ['id' => 'id_cancion'])->inverseOf('traduccions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIdioma()
    {
        return $this->hasOne(Idioma::className(), ['id' => 'id_idioma'])->inverseOf('traduccions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraduccionesUsuarios()
    {
        return $this->hasMany(TraduccionesUsuarios::className(), ['id_traduccion' => 'id'])->inverseOf('idTraduccion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotosTraducciones()
    {
        return $this->hasMany(VotosTraducciones::className(), ['id_traduccion' => 'id'])->inverseOf('idTraduccion');
    }
}
