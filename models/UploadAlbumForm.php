<?php
namespace app\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use phpDocumentor\Reflection\Types\Boolean;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;
use app\models\Album;

class UploadAlbumForm extends Model
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
            $ruta = Yii::getAlias('@albumes/') . $id . '.' . $extension;

            $this->imageFile->saveAs(Yii::getAlias('@albumes/') . $id . '.' . $extension);
            $imagen = Image::getImagine()
                ->open(Yii::getAlias('@albumes/') . $id . '.' . $extension);
            $imagen->thumbnail(new Box(500, $imagen->getSize()->getHeight()))
                    ->save(Yii::getAlias('@albumes/') . $id . '.' . $extension, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}