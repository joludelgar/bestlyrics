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
        <div class="thumbnail">
          <img src="..." alt="...">
          <div class="caption">
            <h3><?= $model->idCancion->nombre ?></h3>
            <p><?= Html::a($artista->nombre, ['/artistas/view', 'id' => $artista->id]) ?></p>
            <p style="text-align:center"><?= Html::a('Ver letra', ['/canciones/view', 'id' => $model->idCancion->id], ['class' => 'btn btn-primary']) ?></p>
          </div>
        </div>
      </div>

</div>
