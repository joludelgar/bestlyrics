<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlbumGeneroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Album Generos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-genero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Album Genero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_album',
            'id_genero',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
