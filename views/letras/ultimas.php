<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LetraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ultimas letras añadidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-ultimas">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row top">
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '/canciones/viewUltimas',
        'layout' => "{items}\n{pager}",
        ]) ?>
    </div>
</div>
