<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_cancion
 * @property string $created_at
 *
 * @property Canciones $idCancion
 * @property User $idUsuario
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_cancion'], 'integer'],
            [['created_at'], 'safe'],
            [['id_cancion'], 'exist', 'skipOnError' => true, 'targetClass' => Cancion::className(), 'targetAttribute' => ['id_cancion' => 'id']],
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
            'id_cancion' => 'Id Cancion',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCancion()
    {
        return $this->hasOne(Cancion::className(), ['id' => 'id_cancion'])->inverseOf('favoritos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario'])->inverseOf('favoritos');
    }
}
