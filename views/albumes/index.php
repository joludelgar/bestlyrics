<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Álbumes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir álbum', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_usuario',
            //'id_artista',
            [
             'label'=>'Usuario',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idUsuario']->username), ['/user/profile/show', 'id' => $data['idUsuario']->id]);
                      },
            ],
            [
             'label'=>'Artista',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idArtista']->nombre), ['/artistas/view', 'id' => $data['idArtista']->id]);
                      },
            ],
            'nombre',
            'anio',
            [
                'label'=>'Género',
                'value'=>'idGenero.nombre',
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
