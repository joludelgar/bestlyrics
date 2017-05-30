<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Favorito;
use app\models\Album;
use yii\widgets\ListView;

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
    $('#bloqueo').click(function() {
        $.ajax({
            method: 'POST',
            url: '$url',
            context: this,
            data: {
                id: $(this).val()
            },
            success: function (data, status, event) {
                if (data) {
                    $(this).html("Desbloquear letra");
                    $('#modificar').html('Letra bloqueada').attr({
                        'href': '#',
                        'disabled': 'disabled',
                        'class': 'btn btn-default'
                    });
                } else {
                    $(this).html("Bloquear letra");
                    $('#modificar').html('Modificar letra').attr({
                        'href': '/letras/update?id='+$(this).val(),
                        'class': 'btn btn-success',
                        'id': 'modificar'
                    });
                    $('#modificar').removeAttr("disabled");
                }
            }
        });
    });

    $('#favorito').click(function(e) {
        $.ajax({
            method: 'POST',
            url: '$url2',
            context: this,
            data: {
                id: $(this).val()
            },
            success: function (data, status, event) {
                $(this).empty();
                $('#contador').empty();
                if (data[0]) {
                    $(this).append('<span class="glyphicon glyphicon-heart" aria-hidden="true" id="iconoLLeno">');
                } else {
                    $(this).append('<span class="glyphicon glyphicon-heart-empty" aria-hidden="true" id="icono"></span>');
                }
                $('#contador').append('<span id="contador">' + data[1] +'</span> Favoritos');
            },
            dataType:"json"
        });
    });
EOT;
$this->registerJs($js);
$this->registerJsFile('@web/js/yt.js');
?>
<div class="cancion-view">

          <div class="row">

            <div class="col-xs-12 col-md-8">
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
                                foreach($model->letras as $letra) {?>
                            <li class=""><a href="#<?=$letra->idIdioma->nombre?>" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" aria-expanded="false"><?=$letra->idIdioma->nombre?></a></li>
                            <?php }}; ?>
                        </ul>
                    </li>
                    <li><?= Html::a('Añadir traducción', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-info']) ?></li>
                    <?php } ?>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active <?= $model->letras == null ? 'anadir-letra' : '' ?>" id="original"></br><?= $model->letras == null ? Html::a('Se el primero en añadir la letra a esta canción.<br/> Haz click aqui para empezar.', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-success btn-anadir-letra']) : nl2br($model->letraOriginal->letra) ?></div>
                    <?php if($model->letras != null) {
                        foreach($model->letras as $letra) {?>
                    <div role="tabpanel" class="tab-pane" id="<?=$letra->idIdioma->nombre?>"></br>
                        <h2><?= $letra->idIdioma->nombre?>
                            <?=$letra->bloqueada ?
                                Html::a('Letra bloqueada',[''], ['class' => 'btn btn-default disabled', 'id' => 'modificar']) :
                                Html::a('Modificar letra', ['letras/update', 'id' => $letra->id], ['class' => 'btn btn-success', 'id' => 'modificar'])?>
                        </h2>
                        <br/><?=nl2br($letra->letra)?></br></div>
                    <?php }}; ?>
                  </div>

                </div>
                <?php if ($model->letras != null) { ?>
                <div class="creator">
                    Letra creada por:
                    <a href="<?= Url::to(['/user/'.$model->idUsuario->id]) ?>">
                    <?= Html::img($model->idUsuario->profile->getImageUrl(), ['class' => 'img-circle']) . ' ' . $model->idUsuario->username ?>
                    </a>
                </div>
                <?php } ?>
                <span style="float:right"><a href="<?=Url::to(['/reportes/create', 'url' => Yii::$app->request->absoluteUrl])?>">Reportar contenido</a></span>

            </div>

            <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                  <div class="panel-body" style='text-align:center;'>
                  <?= $model->video == null ? Html::a('Añadir video', ['video', 'id' => $model->id], ['class' => 'btn btn-success']) :
                  '<div data-video="'. substr($model->video, strpos($model->video, '=')+1, 11) .'"
                     data-autoplay="0"
                     data-loop="1"
                     id="youtube-audio">
                  </div>'
                   . '<br/>' . Html::a('Ver video con letra', ['full', 'id' => $model->id], ['class' => 'btn btn-personalizado'])
                   . '<br/>' . Html::a('Modificar video', ['video', 'id' => $model->id], ['class' => 'btn-xs btn-warning'])?>
                 <!-- <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?=$model->video?>"></iframe>
                </div>-->
                  </div>
                </div>

              <p style='text-align:center;'>
                  <!--<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                  <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?> -->
                  <?= $model->letras == null ? '' :
                        ($model->letraOriginal->bloqueada ?
                            Html::a('Letra bloqueada',[''], ['class' => 'btn btn-default disabled', 'id' => 'modificar']) :
                            Html::a('Modificar letra', ['letras/update', 'id' => $model->letraOriginal->id], ['class' => 'btn btn-success', 'id' => 'modificar'])) . ' ' .
                            (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::button(($model->letraOriginal->bloqueada ? 'Desbloquear letra' : 'Bloquear letra') , ['class' => 'btn btn-warning', 'id' => 'bloqueo', 'value' => $model->letraOriginal->id]) : '' )?>
              </p>

              <div style='text-align:center;margin-top:50px;'>
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

            <div style='text-align:center;margin-top:50px;'>
                <h4>Otras canciones del álbum:</h4>

                <div class="list-group">
                    <?php foreach (Album::findOne($model->idAlbum->id)->canciones as $cancion){
                        if ($cancion->id != $model->id) {?>
                        <a href="<?= Url::to(['/canciones/view', 'id' => $cancion->id]) ?>" class="list-group-item rosa">
                            <?= $cancion->nombre?>
                        </a>
                    <?php }
                    } ?>
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
