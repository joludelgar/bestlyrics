<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LetraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Letras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir letra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_cancion',
            //'id_idioma',
            [
             'label'=>'Canción',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idCancion']->nombre), ['/canciones/view', 'id' => $data['idCancion']->id]);
                      },
            ],
            [
             'label'=>'Idioma',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::encode($data['idIdioma']->nombre);
                      },
            ],
            //'letra:ntext',
            [
             'label'=>'Letra',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::encode(substr($data['letra'], 0, 50) . '...');
                      },
            ],
            'bloqueada:boolean',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
