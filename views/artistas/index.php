<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArtistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Artistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artista-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir artista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_usuario',
            //'nombre',
            [
             'label'=>'Usuario',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idUsuario']->username), ['/user/profile/show', 'id' => $data['idUsuario']->id]);
                      },
            ],
            [
             'label'=>'Nombre',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['nombre']), ['/artistas/view', 'id' => $data['id']]);
                      },
            ],
            'biografia',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
