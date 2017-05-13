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


      <div class="col-sm-6 col-md-4">
        <div class="thumbnail" style="text-align:center">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->id]) ?>">
              <img src="..." alt="...">
              <div class="caption">
                <h3><?= $model->nombre ?></h3>
                <p><?= Html::a($artista->nombre, ['/artistas/view', 'id' => $artista->id]) ?></p>
                <p><?= Html::a('Ver canción', ['/canciones/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
              </div>
            </a>
        </div>
      </div>

</div>
