<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Favorito;
use app\models\Album;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idAlbum->id]];
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['/letras/bloquear']);
$url2 = Url::to(['/favoritos/create']);
$js = <<<EOT
    var url = "$url";
    var url2 = "$url2";
EOT;
$this->registerJs($js, View::POS_HEAD);
$this->registerJsFile('@web/js/yt.js');
$this->registerJsFile('@web/js/tooltips.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/canciones.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<div class="cancion-view">

          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-8 vista-letra">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> -
                        <small><?= Html::a($model->idAlbum->idArtista->nombre, ['artistas/view', 'id' => $model->idAlbum->id_artista]) ?></small>
                    </h1>
                </div>
                <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#original" aria-controls="home" role="tab" data-toggle="tab">Original</a></li>
                    <?php if ($model->letraOriginal) { ?>
                        <li role="presentation" class="dropdown">
                        <a href="#" id="myTabDrop1" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Traducciones <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                            <?php if($model->letras != null) {
                                foreach($model->letras as $letra) {
                                    if ($letra->id != $model->letraOriginal->id) {?>
                            <li class=""><a href="#<?=$letra->idIdioma->nombre?>" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" aria-expanded="false"><?=$letra->idIdioma->nombre?></a></li>
                            <?php   }
                                }
                            }
                            if (count($model->letras) == 1) {?>
                                    <li class="">Sin resultados</li>
                                <?php } ?>
                        </ul>
                    </li>
                    <li><?= Html::a('Añadir traducción', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-panel-traduccion']) ?></li>
                    <?php } ?>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active <?= $model->letras == null ? 'anadir-letra' : '' ?>" id="original"></br><?= $model->letras == null ? Html::a('Se el primero en añadir la letra a esta canción.<br/> Haz click aqui para empezar.', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-default btn-anadir-letra']) : nl2br($model->letraOriginal->letra) ?></div>
                    <?php if($model->letras != null) {
                        foreach($model->letras as $letra) {?>
                    <div role="tabpanel" class="tab-pane" id="<?=$letra->idIdioma->nombre?>"></br>
                        <h2><?= $letra->idIdioma->nombre?>
                            <?=$letra->bloqueada ?
                                Html::a('Letra bloqueada',[''], ['class' => 'btn btn-default disabled modificar']) :
                                Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>', ['letras/update', 'id' => $letra->id], ['class' => 'btn btn-primary btn-traduccion', 'id' => 'modificar', 'data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"Modificar traducción"])?>
                        </h2>
                        <br/><?=nl2br($letra->letra)?></br></div>
                    <?php }}; ?>
                  </div>

                </div>
                <?php if ($model->letras != null) { ?>
                <div class="creator">
                    Canción creada por:
                    <a href="<?= Url::to(['/user/'.$model->idUsuario->id]) ?>">
                    <?= Html::img($model->idUsuario->profile->getImageUrl(), ['class' => 'img-circle']) . ' ' . $model->idUsuario->username ?>
                    </a>
                </div>
                <?php } ?>
                <?php
                 if (!Yii::$app->user->isGuest) {
                    Modal::begin([
                        'toggleButton' => [
                            'label' => 'Reportar contenido',
                            'class' => 'btn btn-link reporte reporte-right'
                        ],
                        'closeButton' => [
                          'label' => 'Cerrar',
                          'class' => 'btn btn-danger btn-sm pull-right',
                        ],
                        'size' => 'modal-lg',
                    ]);

                    echo $render;

                    Modal::end();
                };
                ?>

            </div>

            <div class="col-xs-12 col-md-4 panel-letra">
                  <?php if ($model->letraOriginal) { ?>
                  <div class="panel text-center">
                  <?= $model->video == null ? Html::a('Añadir video', ['video', 'id' => $model->id], ['class' => 'btn btn-panel']) :
                  '<div data-video="'. substr($model->video, strpos($model->video, '=')+1, 11) .'"
                     data-autoplay="0"
                     data-loop="1"
                     id="youtube-audio">
                  </div>'
                   . '<br/>' . Html::a('Ver video con letra', ['full', 'id' => $model->id], ['class' => 'btn btn-personalizado'])
                   . '<br/>'?>
                  </div>
                  <?php } ?>

              <p class='text-center'>
                  <?= Html::a('<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>', ['video', 'id' => $model->id], ['class' => 'btn btn-default', 'data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"Modificar video"])?>
                  <?= $model->letras == null ? '' :
                        ($model->letraOriginal->bloqueada ?
                            Html::a('Letra bloqueada',[''], ['class' => 'btn btn-default disabled modificar']) :
                            Html::a('Modificar letra', ['letras/update', 'id' => $model->letraOriginal->id], ['class' => 'btn btn-default modificar'])) . ' ' .
                            (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::button(($model->letraOriginal->bloqueada ? 'Desbloquear letra' : 'Bloquear letra') , ['class' => 'btn btn-warning', 'id' => 'bloqueo', 'value' => $model->letraOriginal->id]) : '' )?>
              </p>

              <div class="text-center fav">
                  <div class="row">
                  <div id="botonFavorito">
                      <?php if (Yii::$app->user->isGuest || !Favorito::findOne(['id_cancion' => $model->id, 'id_usuario' => Yii::$app->user->identity->id])) { ?>
                          <button href="javascript:void(0);" type="button" class="btn btn-default" id="favorito" aria-label="Favorito" value=<?=$model->id?>>
                              <span class="glyphicon glyphicon-heart-empty" aria-hidden="true" id="icono"></span>
                          </button>
                      <?php } else {?>
                          <button type="button" class="btn btn-default" id="favorito" aria-label="Favorito" value=<?=$model->id?>>
                              <span class="glyphicon glyphicon-heart" aria-hidden="true" id="iconoLLeno"></span>
                          </button>
                      <?php } ?>
                      <div id="contador">
                          <span><?= count($model->favoritos); ?></span> Favoritos
                      </div>
                  </div>
              </div>
            </div>

            <div class='text-center fav'>
                <h4 class="titulo-panel-cancion">Otras canciones del álbum:</h4>

                <div class="list-group">
                    <?php
                    $contador=0;
                    foreach (Album::findOne($model->idAlbum->id)->canciones as $cancion){
                        if ($cancion->id != $model->id && $contador < 2) {?>
                        <a href="<?= Url::to(['/canciones/view', 'id' => $cancion->id]) ?>" class="list-group-item rosa">
                            <?= $cancion->nombre?>
                        </a>
                    <?php $contador += 1; }
                    } ?>
                    <?php if (count(Album::findOne($model->idAlbum->id)->canciones) > 1 || !$model->letraOriginal) { ?>
                        <a href="<?= Url::to(['/albumes/view', 'id' => $model->idAlbum->id]) ?>" class="list-group-item rosa">
                            Ver más
                        </a>
                    <?php } ?>
                </div>

            </div>

            </div>
    </div>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
      'model' => $model,
      'maxLevel' => 3,
      'entityIdAttribute' => 'id',
      // set `pageSize` with custom sorting
      'dataProviderConfig' => [
          'sort' => [
              'attributes' => ['id'],
              'defaultOrder' => ['id' => SORT_DESC],
          ],
          'pagination' => [
              'pageSize' => 10
          ],
      ],
          // your own config for comments ListView, for example:
         'listViewConfig' => [
             'emptyText' => Yii::t('app', 'No hay comentarios.'),
         ]
]); ?>

</div>

<script src="https://www.youtube.com/iframe_api"></script>
