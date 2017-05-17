<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Favorito;

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
?>
<div class="cancion-view">

    <div class="panel panel-default">
      <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                  <div class="panel-body" style='text-align:center;'>
                  <?= $model->video == null ? Html::a('Añadir video', ['video', 'id' => $model->id], ['class' => 'btn btn-success']) :
                  Html::tag('div', Html::tag('iframe', '', ['class' => 'embed-responsive-item', 'src' => str_replace("watch?v=", "embed/", $model->video)]), ['class' => 'embed-responsive embed-responsive-16by9']) .
                  '<br/>' . Html::a('Modificar video', ['video', 'id' => $model->id], ['class' => 'btn-xs btn-warning'])?>
                 <!-- <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?=$model->video?>"></iframe>
                </div>-->
                  </div>
                </div>
              </a>
              <p style='text-align:center;'>
                  <!--<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                  <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?> -->
                  <?= $model->letras == null ? Html::a('Añadir letra', ['letras/create', 'id' => $model->id], ['class' => 'btn btn-success']) :
                        ($model->letras[0]->bloqueada ?
                            Html::a('Letra bloqueada',[''], ['class' => 'btn btn-default disabled', 'id' => 'modificar']) :
                            Html::a('Modificar letra', ['letras/update', 'id' => $model->letras[0]->id], ['class' => 'btn btn-success', 'id' => 'modificar'])) . ' ' .
                            (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::button(($model->letras[0]->bloqueada ? 'Desbloquear letra' : 'Bloquear letra') , ['class' => 'btn btn-warning', 'id' => 'bloqueo', 'value' => $model->letras[0]->id]) : '' )?>
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
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> -
                        <small><?= Html::a($model->idAlbum->idArtista->nombre, ['artistas/view', 'id' => $model->idAlbum->id_artista]) ?></small>
                    </h1>
                </div>
                <span style="float:right"><a href="<?=Url::to(['/reportes/create', 'url' => Yii::$app->request->absoluteUrl])?>">Reportar contenido</a></span>
                <?= $model->letras == null ? '' : nl2br($model->letras[0]->letra) ?>
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
