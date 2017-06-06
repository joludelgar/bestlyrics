<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
$artista = $model->idAlbum->idArtista;
?>

<div class="cancion-view">

      <div class="col-sm-12 col-md-9 col-md-offset-3 cancion-top">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->id]) ?>">
              <div class="caption">
                <h4 class="rosa">
                    <span style="color:black;"><?=($index + 1)?></span>
                    <?=$model->nombre?>
                </h4>
              </div>
            </a>
        </div>

</div>
