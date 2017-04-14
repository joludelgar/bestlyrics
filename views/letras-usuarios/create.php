<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LetraUsuario */

$this->title = 'Create Letra Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Letra Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
