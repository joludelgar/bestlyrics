<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VotoLetra */

$this->title = 'Create Voto Letra';
$this->params['breadcrumbs'][] = ['label' => 'Voto Letras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voto-letra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
