<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Letra */

$this->title = 'Create Letra';
$this->params['breadcrumbs'][] = ['label' => 'Letras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
