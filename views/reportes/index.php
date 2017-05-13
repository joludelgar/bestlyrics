<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reporte', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
             'label'=>'Usuario',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a(Html::encode($data['idReportador']->username), ['/user/profile/show', 'id' => $data['idReportador']->id]);
                      },
            ],
            'comentario:ntext',
            [
             'label'=>'Enlace',
             'format' => 'raw',
             'value'=>function ($data) {
                        return Html::a('Enlace al contenido', $data['enlace']);
                      },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
