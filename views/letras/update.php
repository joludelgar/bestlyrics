<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letra */

$this->title = 'Modificar letra de ' . $model->idCancion->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->idAlbum->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idCancion->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idCancion->idAlbum->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->nombre, 'url' => ['canciones/view', 'id' => $model->idCancion->id]];
$this->params['breadcrumbs'][] = 'Modificar letra';
?>
<div class="letra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
