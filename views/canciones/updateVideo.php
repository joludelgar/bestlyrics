<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->title = 'Modificar video de ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idAlbum->id]];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['canciones/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar url';
?>
<div class="cancion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_video', [
        'model' => $model,
    ]) ?>

</div>
