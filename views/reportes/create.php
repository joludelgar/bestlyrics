<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reporte */

$this->title = 'Reportar contenido';
?>
<div class="reporte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
