<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Artista */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artista-view">

    <div class="panel panel-default">
      <div class="panel-body">
          <div class="row">
            <div class="col-xs-6 col-md-3">
              <a href="#" class="thumbnail">
                <img src="/imagenes/example.jpg" alt="...">
              </a>
            </div>
            <div class="col-xs-6 col-md-9">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <p><?= Html::encode($model->biografia) ?></p>
            </div>
          </div>
      </div>
    </div>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Yii::$app->user->identity->isAdmin ? Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : '' ?>
        <?= Html::a('Añadir nuevo álbum', ['albumes/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

     <!--<?=  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'nombre',
            'biografia',
            'created_at',
        ],
    ])  ?> -->

    <h2>Albumes</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
             'label'=>'Nombre del álbum',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['nombre']), ['/albumes/view', 'id' => $data['id']]);
                      },
             ],
            [
                'label'=>'Año de lanzamiento',
                'value'=>'anio'
            ],
            //'created_at',
        ],
        'layout' => "{items}\n{pager}",
    ]) ?>

</div>
