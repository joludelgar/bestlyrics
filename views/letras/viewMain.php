<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
$artista = $model->idCancion->idAlbum->idArtista;
?>

<div class="cancion-view">

      <div class="col-sm-6 col-md-2">
        <div class="thumbnail text-center" style="background:url('<?= $model->idCancion->idAlbum->getImageUrl()?>');background-size: cover;background-repeat: no-repeat;background-position: center;">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->idCancion->id]) ?>">
              <div class="caption cancion-view-main" itemscope itemtype="http://schema.org/MusicComposition">
                <h3 class="rosa" itemprop="name"><?= $model->idCancion->nombre ?></h3>
                <p class="rosa" itemprop="composer"><?=$artista->nombre?></p>
                <p itemprop="lyrics"><?= substr($model->letra, 0, 50) . '...' ?></p>
              </div>
            </a>
        </div>
      </div>

</div>
