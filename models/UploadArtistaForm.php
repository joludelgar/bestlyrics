<?php
namespace app\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use phpDocumentor\Reflection\Types\Boolean;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;
use app\models\Artista;

/**
 * Modelo formulario para la subida de imagenes para Artista.
 */
class UploadArtistaForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'],'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            $extension = $this->imageFile->extension;
            $ruta = Yii::getAlias('@artistas/') . $id . '.' . $extension;

            $this->imageFile->saveAs(Yii::getAlias('@artistas/') . $id . '.' . $extension);
            $imagen = Image::getImagine()
                ->open(Yii::getAlias('@artistas/') . $id . '.' . $extension);
            $imagen->thumbnail(new Box(500, $imagen->getSize()->getHeight()))
                    ->save(Yii::getAlias('@artistas/') . $id . '.' . $extension, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}
