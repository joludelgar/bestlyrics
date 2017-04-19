<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Artista */

$this->title = 'Añadir nuevo artista';
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
