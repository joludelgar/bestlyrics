<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LetraUsuario */

$this->title = 'Update Letra Usuario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Letra Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="letra-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
