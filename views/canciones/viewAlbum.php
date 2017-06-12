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

      <div class="col-xs-12 col-sm-12 col-md-12 cancion-top">
            <a href="<?= Url::to(['/canciones/view', 'id' => $model->id]) ?>" class="col-xs-10 col-sm-10">
              <div class="caption">
                <h4 class="rosa">
                    <span class="negro"><?=($index + 1)?></span>
                    <?=$model->nombre?>
                </h4>
              </div>
            </a>
            <span class="botones-canciones col-xs-2 col-sm-2">
            <?= Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>', ['/canciones/update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Modificar canción"]) ?>

            <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', ['/canciones/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-xs',
                'data-toggle'=>"tooltip",
                'data-placement'=>"top",
                'title'=>"Eliminar canción",
                'data' => [
                    'confirm' => '¿Estás seguro?',
                    'method' => 'post',
                ],
            ]) : '' ?>
            </span>
        </div>

</div>
