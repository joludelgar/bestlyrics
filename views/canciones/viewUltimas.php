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

      <div class="col-sm-12 col-md-12 cancion-top">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->idCancion->id]) ?>">
              <div class="caption">
                <h4 class="rosa">
                    <span style="color:black;"><?=($index + 1)?></span>
                    <?=$model->idCancion->nombre?> -
                    <span><?=$artista->nombre?></span>
                    <span class="top-right"><?=$model->idIdioma->nombre?>
                    </span>
                </h4>
              </div>
            </a>
        </div>

</div>
