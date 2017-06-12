<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Genero */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-view">

    <h1>Artistas de <?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '/artistas/viewSearch',
        'layout' => "{items}\n{pager}",
        ]) ?>
    </div>

</div>
