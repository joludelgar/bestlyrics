<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artista/index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->idArtista->nombre, 'url' => ['artista/view', 'id' => $model->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idAlbum->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'id_album',
            'nombre',
            'video',
            'created_at',
        ],
    ]) ?>

</div>
