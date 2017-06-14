<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use app\models\Reporte;

/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idArtista->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/album.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/tooltips.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<div class="album-view">


          <div class="row">
            <div class="col-xs-12 col-md-3 album-view-1">
                <a href="#" class="<?= $model->getImageUrl() == '/' . Yii::getAlias('@albumes') . '/disco.png' ? 'album' : 'disabled'?>">
                    <div>

                    </div>
                </a>

                <div style="display:none;">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($albumForm, 'imageFile')->fileInput(['style' => 'visibility: hidden', 'label' => 'none', 'class' => 'upload'])->label(false) ?>

                    <?php ActiveForm::end(); ?>

                </div>
                <p>
                    <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Eliminar imagen', ['delete-imagen', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-xs',
                        'data' => [
                            'confirm' => '¿Estás seguro?',
                            'method' => 'post',
                        ],
                    ]) : '' ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> <small><?= Html::encode($model->anio) ?></small></h1>
                </div>
                <p>
                    <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir canción', ['canciones/create', 'id' => $model->id], ['class' => 'btn btn-personalizado']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-oculto btn-vertical-align']) ?>
                    <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-oculto',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) : '' ?>

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

                </p>
                <!-- Table -->
                <table class="table">
                    <div class="row top">
                        <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => '/canciones/viewAlbum',
                        'layout' => "{items}\n{pager}",
                        ]) ?>
                    </div>
              </table>
            </div>
    </div>

    <!--<h1><?= Html::encode($this->title) ?></h1> -->

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'id_artista',
            'nombre',
            'anio',
            'created_at',
        ],
    ]) ?>-->



</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<style type="text/css">

    .album div, .disabled div {
        background-image: url('<?= $model->getImageUrl()?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

</style>
