<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "votos_letras".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_letra
 * @property integer $voto
 *
 * @property Letras $idLetra
 * @property User $idUsuario
 */
class VotoLetra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votos_letras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_letra', 'voto'], 'integer'],
            [['voto'], 'required'],
            [['id_letra'], 'exist', 'skipOnError' => true, 'targetClass' => Letra::className(), 'targetAttribute' => ['id_letra' => 'id']],
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
            'id_letra' => 'Id Letra',
            'voto' => 'Voto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLetra()
    {
        return $this->hasOne(Letra::className(), ['id' => 'id_letra'])->inverseOf('votoLetras');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('votoLetras');
    }
}
