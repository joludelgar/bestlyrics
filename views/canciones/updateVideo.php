<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->title = 'Update Cancion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cancions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cancion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_video', [
        'model' => $model,
    ]) ?>

</div>
