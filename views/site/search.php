<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Resultados de la busqueda de: "'.$q.'"';
?>

<h2><?=$this->title?></h2>

<br>

<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#canciones" aria-controls="canciones" role="tab" data-toggle="tab">Canciones (<?= $cancionesProvider->getTotalCount() ?>)</a></li>
  <li role="presentation"><a href="#artistas" aria-controls="artistas" role="tab" data-toggle="tab">Artistas (<?= $artistasProvider->getTotalCount() ?>)</a></li>
  <li role="presentation"><a href="#albumes" aria-controls="albumes" role="tab" data-toggle="tab">Álbumes (<?= $albumesProvider->getTotalCount() ?>)</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="canciones"></br>
      <div class="row">
          <?= ListView::widget([
          'dataProvider' => $cancionesProvider,
          'itemOptions' => ['class' => 'item'],
          'itemView' => '/canciones/viewSearch',
          'layout' => "{items}\n{pager}",
          ]) ?>
      </div>

          <h3 style="text-align:center;">
              Si no encuentras la canción contribuye añadiendola. Busca el artista y si existe el álbum añade la canción. Si no existen ni el artista ni el álbum, ¡créalos!
          </h3>
  </div>
  <div role="tabpanel" class="tab-pane" id="artistas"></br>
      <div class="row">
          <?= ListView::widget([
          'dataProvider' => $artistasProvider,
          'itemOptions' => ['class' => 'item'],
          'itemView' => '/artistas/viewSearch',
          'layout' => "{items}\n{pager}",
          ]) ?>
      </div>

          <h3 style="text-align:center;">
              Si no encuentras el artista, añádelo y forma parte de la comunidad de Bestlyrics.
          </h3>
          <p style="text-align:center;">
              <?= Html::a('Añadir artista', ['/artistas/create'], ['class' => 'btn btn-success btn-lg']) ?>
          </p>
  </div>
  <div role="tabpanel" class="tab-pane" id="albumes"></br>
      <div class="row">
          <?= ListView::widget([
          'dataProvider' => $albumesProvider,
          'itemOptions' => ['class' => 'item'],
          'itemView' => '/albumes/viewSearch',
          'layout' => "{items}\n{pager}",
          ]) ?>
      </div>

          <h3 style="text-align:center;">
              Si no encuentras el álbum busca el artista al que pertenece y añádelo. Si no existe el artista, ¡créalo!
          </h3>
  </div>
</div>
