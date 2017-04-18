<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/index']];
$this->params['breadcrumbs'][] = ['label' => $model->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idArtista->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-body">
          <div class="row">
            <div class="col-xs-6 col-md-3">
              <a href="#" class="thumbnail">
                <img src="/imagenes/example.jpg" alt="...">
              </a>
            </div>
            <div class="col-xs-6 col-md-9">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> <small><?= Html::encode($model->anio) ?></small></h1>
                </div>
                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) : '' ?>
                    <?= Html::a('Añadir canción', ['canciones/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
          </div>
      </div>

      <!-- Table -->
      <table class="table">


      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'columns' => [
              [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:100px;'],
              ],
              [
               'label'=>'Canciones',
               'format' => 'raw',
               'value'=>function ($data) {
                   return Html::a(Html::encode($data['nombre']), ['/canciones/view', 'id' => $data['id']]);
               },
               ],
               [
                'format' => 'raw',
                'value' => function($data) {
                        return Html::a('Modificar canción', ['/canciones/update', 'id' => $data['id']], ['class' => 'btn-sm btn-primary']) . ' ' .
                        (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('Eliminar canción', ['/canciones/delete', 'id' => $data['id']], [
                            'class' => 'btn-sm btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) : '');
                }
               ],
          //'created_at',
          ],
          'layout' => "{items}\n{pager}",
        ]) ?>
    </table>
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
