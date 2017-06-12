<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
$artista = $model->idArtista;
?>

<div class="album-view">


      <div class="col-xs-12 col-md-4">
        <div class="thumbnail text-center">
            <a href="<?= Url::to(['/albumes/view', 'id' => $model->id]) ?>">
              <img src="<?=$model->getImageUrl();?>" alt="<?=$model->nombre?>">
              <div class="caption albumMain">
                <h3><?= $model->nombre ?></h3>
                <p><?= $model->anio ?></p>
              </div>
            </a>
        </div>
      </div>

</div>
