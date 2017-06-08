<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "reportes".
 *
 * @property integer $id
 * @property integer $id_reportador
 * @property string $comentario
 * @property string $enlace
 *
 * @property User $idReportador
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_reportador'], 'integer'],
            [['comentario', 'enlace'], 'required'],
            [['comentario'], 'string'],
            [['enlace'], 'string', 'max' => 255],
            [['id_reportador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_reportador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_reportador' => 'Id Reportador',
            'comentario' => 'Comentario',
            'enlace' => 'Enlace',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdReportador()
    {
        return $this->hasOne(User::className(), ['id' => 'id_reportador'])->inverseOf('reportes');
    }
}
