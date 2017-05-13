<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = 'Añadir álbum';
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idArtista->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'generos' => $generos,
    ]) ?>

</div>
