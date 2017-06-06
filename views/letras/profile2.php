<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Letra;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
$artista = $model->idLetra->idCancion->idAlbum->idArtista;
$formatter = \Yii::$app->formatter;
?>

<div class="cancion-view">


    <div class="col-sm-12 col-md-12 letras-perfil" style="border:1px solid #f5f5f5">
          <a href="<?= Url::to(['/canciones/view', 'id' => $model->idLetra->idCancion->id]) ?>">
            <div class="caption">
              <h4 class="rosa"><?= $model->idLetra->idCancion->nombre ?> - <small class="rosa"><?=$artista->nombre?></small></h4>
              <?php
              $letra = Letra::find()->where(['id_cancion' => $model->idLetra->idCancion->id])->orderBy('created_at')->one();
              if ($model->idLetra->id == $letra->id) {?>
                  <p>Añadida el <?=$formatter->asDate($model->created_at, 'long');?></p>
              <?php } else { ?>
                  <p>Modificada el <?=$formatter->asDate($model->created_at, 'long');?></p>
              <?php } ?>
            </div>
          </a>
    </div>

</div>
