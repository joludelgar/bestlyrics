<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Idioma */

$this->title = 'Create Idioma';
$this->params['breadcrumbs'][] = ['label' => 'Idiomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="idioma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
