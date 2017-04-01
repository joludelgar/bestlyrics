<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Traduccion */

$this->title = 'Create Traduccion';
$this->params['breadcrumbs'][] = ['label' => 'Traduccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traduccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
