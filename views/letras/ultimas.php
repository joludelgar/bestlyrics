<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LetraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ultimas letras añadidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-ultimas">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
             'label'=>'Canción',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data->idCancion->nombre), ['/canciones/view', 'id' => $data->idCancion->id]);
                      },
             ],
            [
             'label'=>'Artista',
             'format' => 'raw',
             'value'=>function ($data) {
                        $artista = $data->idCancion->idAlbum->idArtista;
                        return Html::a(Html::encode($artista->nombre), ['/artistas/view', 'id' => $artista->id]);
                      },
             ],
            //'id',
            //'id_cancion',
            //'id_idioma',
            //'letra:ntext',
            //'bloqueada:boolean',
            //'created_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
