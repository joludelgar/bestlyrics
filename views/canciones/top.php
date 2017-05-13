<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CancionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Top Mensual de Canciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_usuario',
            //'id_album',
            [
             'label'=>'Nombre',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data->nombre), ['/canciones/view', 'id' => $data['id']]);
                      },
            ],
            [
             'label'=>'Album',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idAlbum']->nombre), ['/albumes/view', 'id' => $data['idAlbum']->id]);
                      },
            ],
            [
             'label'=>'Artista',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idAlbum']->idArtista->nombre), ['/artistas/view', 'id' => $data['idAlbum']->idArtista->id]);
                      },
            ],
            //'nombre',
            //'id_letra_original',
            //'video',
            //'created_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
