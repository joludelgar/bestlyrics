<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AlbumGenero */

$this->title = 'Update Album Genero: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Album Generos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="album-genero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
