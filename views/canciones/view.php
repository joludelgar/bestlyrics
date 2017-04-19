<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idAlbum->idArtista->id]];
$this->params['breadcrumbs'][] = ['label' => $model->idAlbum->nombre, 'url' => ['albumes/view', 'id' => $model->idAlbum->id]];
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['/letras/bloquear']);
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
EOT;
$this->registerJs($js);
?>
<div class="cancion-view">

    <div class="panel panel-default">
      <div class="panel-body">
          <div class="row">
            <div class="col-xs-6 col-md-4">
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
                            Html::a('Modificar letra', ['letras/update', 'id' => $model->id], ['class' => 'btn btn-success', 'id' => 'modificar'])) . ' ' .
                            (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::button(($model->letras[0]->bloqueada ? 'Desbloquear letra' : 'Bloquear letra') , ['class' => 'btn btn-warning', 'id' => 'bloqueo', 'value' => $model->id]) : '' )?>
              </p>
            </div>
            <div class="col-xs-6 col-md-8">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> -
                        <small><?= Html::a($model->idAlbum->idArtista->nombre, ['artistas/view', 'id' => $model->idAlbum->id_artista]) ?></small>
                    </h1>
                </div>
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
