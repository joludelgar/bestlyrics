<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letra */

$this->title = 'Letra de ' . $model->idCancion->nombre;;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->idAlbum->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idCancion->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idCancion->idAlbum->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idCancion->nombre, 'url' => ['canciones/view', 'id' => $model->idCancion->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cancion',
            'id_idioma',
            'letra:ntext',
            'bloqueada:boolean',
            'created_at',
        ],
    ]) ?>

</div>
