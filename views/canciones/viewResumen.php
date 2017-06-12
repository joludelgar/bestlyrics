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

      <div class="col-sm-12 col-md-8 col-md-offset-2 cancion-top">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->id]) ?>">
              <div class="caption">
                <h4 class="rosa">
                    <span class="negro"><?=($index + 1)?></span>
                    <?=$model->nombre?> -
                    <span><?=$artista->nombre?></span>
                    <span class="top-right"><?=count($model->favoritos)?>
                        <span class="glyphicon glyphicon-heart-empty" aria-hidden="true" id="icono-top"></span>
                    </span>
                </h4>
              </div>
            </a>
        </div>

</div>
