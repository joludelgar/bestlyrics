<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArtistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Artistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artista-ultimos">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn-ultimos float-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" id="icono"></span> Añadir nuevo artista', ['create'], ['class' => 'btn btn-personalizado']) ?>
    </p>

    <div class="row">
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '/artistas/viewSearch',
        'layout' => "{items}\n{pager}",
        ]) ?>
    </div>
</div>
