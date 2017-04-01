<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letras".
 *
 * @property integer $id
 * @property integer $id_cancion
 * @property string $letra
 * @property boolean $bloqueada
 * @property string $created_at
 *
 * @property Canciones $idCancion
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
            [['id_cancion'], 'integer'],
            [['letra'], 'required'],
            [['bloqueada'], 'boolean'],
            [['created_at'], 'safe'],
            [['letra'], 'string', 'max' => 5000],
            [['id_cancion'], 'exist', 'skipOnError' => true, 'targetClass' => Cancion::className(), 'targetAttribute' => ['id_cancion' => 'id']],
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
            'letra' => 'Letra',
            'bloqueada' => 'Bloqueada',
            'created_at' => 'Created At',
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
    public function getLetrasUsuarios()
    {
        return $this->hasMany(LetrasUsuarios::className(), ['id_letra' => 'id'])->inverseOf('idLetra');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotosLetras()
    {
        return $this->hasMany(VotosLetras::className(), ['id_letra' => 'id'])->inverseOf('idLetra');
    }
}
