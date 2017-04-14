<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VotoLetraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voto Letras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voto-letra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Voto Letra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_usuario',
            'id_letra',
            'voto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
