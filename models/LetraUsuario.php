<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letras_usuarios".
 *
 * @property integer $id
 * @property integer $id_letra
 * @property integer $id_usuario
 * @property string $created_at
 *
 * @property Letras $idLetra
 * @property User $idUsuario
 */
class LetraUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letras_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_letra', 'id_usuario'], 'integer'],
            [['created_at'], 'safe'],
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
            'id_letra' => 'Id Letra',
            'id_usuario' => 'Id Usuario',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLetra()
    {
        return $this->hasOne(Letra::className(), ['id' => 'id_letra'])->inverseOf('letraUsuarios');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('letraUsuarios');
    }
}
