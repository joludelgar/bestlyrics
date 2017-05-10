<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Panel de administración';
?>
<div class="site-admin"style="text-align:center;">

    <a href="<?=Url::to(['/user/admin'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar usuarios</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/artistas/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar artistas</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/albumes/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar álbumes</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/canciones/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar canciones</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/letras/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar letras</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/favoritos/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar favoritos</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/idiomas/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar idiomas</h2>
        </div>
    </a>

    <a href="<?=Url::to(['/generos/index'])?>">
        <div class="jumbotron col-sm-12 col-md-4">
            <h2>Administrar géneros</h2>
        </div>
    </a>
</div>
