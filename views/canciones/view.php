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

    <div class="panel panel-default">
      <div class="panel-body">
          <div class="row">
            <div class="col-xs-6 col-md-4">
              <a href="#" class="thumbnail">
                <img src="/imagenes/example.jpg" alt="...">
              </a>
              <p>
                  <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                  <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?>
                  <?= $model->letras == null ? Html::a('Añadir letra', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-success']) :
                        Html::a('Modificar letra', ['letras/update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
              </p>
            </div>
            <div class="col-xs-6 col-md-8">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <?= $model->letras == null ? '' : nl2br($model->letras->letra) ?>
            </div>
          </div>
      </div>
    </div>

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'id_album',
            'nombre',
            'video',
            'created_at',
        ],
    ]) ?>-->

</div>
