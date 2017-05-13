<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Bestlyrics';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>¡Bienvenido a Bestlyrics!</h1>

        <p class="lead">Encuentra la letra de tus canciones favoritas y participa añadiendo letras</p>

        <p><a class="btn btn-lg btn-success" href="#">Proximamente será un buscador</a></p>
    </div>

    <div class="body-content">
        <h2>Top Mensual de Canciones:</h2>

        <div class="row">
            <?= ListView::widget([
            'dataProvider' => $dataProvider2,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '/canciones/viewMain',
            'layout' => "{items}\n{pager}",
            ]) ?>
        </div>
        <div class="mas" style="text-align:center">
            <?= Html::a('Ver más', ['/canciones/top'], ['class' => 'btn btn-default']) ?>
        </div>

        <h2>Ultimas letras añadidas:</h2>

        <div class="row">
            <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '/letras/viewMain',
            'layout' => "{items}\n{pager}",
            ]) ?>
        </div>
        <div class="mas" style="text-align:center">
            <?= Html::a('Ver más', ['/letras/ultimas'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
