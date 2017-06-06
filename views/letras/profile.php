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


    <div class="col-sm-6 col-md-4">
      <div class="thumbnail" style="text-align:center;background:url('<?= $model->idCancion->idAlbum->getImageUrl()?>');background-size: cover;background-repeat: no-repeat;background-position: center;">
          <a href="<?= Url::to(['/canciones/view', 'id' => $model->idCancion->id]) ?>">
            <div class="caption" style="height:130px;">
              <h3 class="rosa"><?= $model->idCancion->nombre ?></h3>
              <p class="rosa"><?=$artista->nombre?></p>
            </div>
          </a>
      </div>
    </div>

</div>
