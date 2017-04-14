<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AlbumGenero */

$this->title = 'Create Album Genero';
$this->params['breadcrumbs'][] = ['label' => 'Album Generos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-genero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
