<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LetraUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Letra Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letra-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Letra Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
             'label'=>'Canción',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idLetra']->idCancion->nombre), ['/canciones/view', 'id' => $data['idLetra']->idCancion->id]);
                      },
            ],
            [
             'label'=>'Idioma',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::encode($data['idLetra']->idIdioma->nombre);
                      },
            ],
            [
             'label'=>'Letra',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::encode(substr($data['idLetra']->letra, 0, 50) . '...');
                      },
            ],
            [
             'label'=>'Usuario',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idUsuario']->username), ['/user/profile/show', 'id' => $data['idUsuario']->id]);
                      },
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
