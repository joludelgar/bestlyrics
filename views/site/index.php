<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use app\assets\ScriptAsset;

ScriptAsset::register($this);

$this->title = 'Bestlyrics';

$urlCanciones = Url::to(['/site/canciones']) . '?q=%QUERY';
$urlArtistas = Url::to(['/site/artistas']) . '?q=%QUERY';
$urlAlbumes = Url::to(['/site/albumes']) . '?q=%QUERY';
$artistasView = Url::to(['/artistas/view']) . '?id=';
$cancionesView = Url::to(['/canciones/view']) . '?id=';
$albumesView = Url::to(['/albumes/view']) . '?id=';

$js = <<<JS
var urlCanciones = "$urlCanciones";
var urlArtistas = "$urlArtistas";
var urlAlbumes = "$urlAlbumes";
var artistasView = "$artistasView";
var cancionesView = "$cancionesView";
var albumesView = "$albumesView";
JS;
$this->registerJs($js, View::POS_HEAD);
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>¡Bienvenido a Bestlyrics!</h1>

        <p class="lead">Encuentra la letra de tus canciones favoritas y participa añadiendo letras</p>

        <div class="search-index">
            <form class="form-index row" method="GET" action="<?=Url::to(['/site/search'])?>">
                <div class="form-group search-form">
                    <input type="text" name="q" class="form-control typeahead" placeholder=" Busca canciones, artistas o álbumes">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form>
        </div>
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
            'itemOptions' => ['class' => 'item crop'],
            'itemView' => '/letras/viewMain',
            'layout' => "{items}\n{pager}",
            ]) ?>
        </div>
        <div class="mas" style="text-align:center">
            <?= Html::a('Ver más', ['/letras/ultimas'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
