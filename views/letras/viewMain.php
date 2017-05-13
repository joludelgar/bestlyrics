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
        <div class="thumbnail">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->idCancion->id]) ?>">
              <img src="..." alt="...">
              <div class="caption">
                <h3><?= $model->idCancion->nombre ?></h3>
                <p><?= Html::a($artista->nombre, ['/artistas/view', 'id' => $artista->id]) ?></p>
                <p><?= substr($model->letra, 0, 50) . '...' ?></p>
                <p><?= Html::a('Ver letra completa', ['/canciones/view', 'id' => $model->idCancion->id], ['class' => 'btn btn-primary']) ?></p>
              </div>
            </a>
        </div>
      </div>

</div>
