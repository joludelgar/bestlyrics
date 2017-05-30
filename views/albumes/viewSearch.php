<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
?>

<div class="cancion-view">


      <div class="col-sm-12 col-md-12 album-search">
            <a href="<?= Url::to(['/albumes/view', 'id' => $model->id]) ?>">
              <div class="caption searched row">
                <div class="col-sm-3 col-md-3 image-search img-circle col-md-12" style="background:url('<?= $model->getImageUrl(); ?>');background-size: cover;background-repeat: no-repeat;background-position:center;"></div>
                <h3 class="rosa col-sm-9 col-md-9"><?= $model->nombre?> - <small><?= $model->idArtista->nombre ?></small></h3>
                </div>
            </a>
        </div>

</div>
