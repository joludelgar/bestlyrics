<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CancionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir canción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_usuario',
            //'id_album',
            [
             'label'=>'Usuario',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idUsuario']->username), ['/user/profile/show', 'id' => $data['idUsuario']->id]);
                      },
            ],
            [
             'label'=>'Album',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idAlbum']->nombre), ['/albumes/view', 'id' => $data['idAlbum']->id]);
                      },
            ],
            //'nombre',
            [
             'label'=>'Nombre',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data->nombre), ['/canciones/view', 'id' => $data['id']]);
                      },
            ],
            'id_letra_original',
            'video',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
