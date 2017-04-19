<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArtistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Artistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artista-ultimos">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Añadir artista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_usuario',
            //'nombre',
            [
             'label'=>'Nombre',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['nombre']), ['/artistas/view', 'id' => $data['id']]);
                      },
             ],
            //'biografia',
            //'created_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
