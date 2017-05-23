<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['artistas/ultimos']];
$this->params['breadcrumbs'][] = ['label' => $model->idArtista->nombre, 'url' => ['artistas/view', 'id' => $model->idArtista->id]];
$this->params['breadcrumbs'][] = $this->title;
$js = <<<JS
$('.album').click(function(){
    $('input[type=file]').click();
    return false;
});

$(".uploadAvatar").change(function() {
    this.form.submit();
})
JS;
$this->registerJs($js);
?>
<div class="album-view">


          <div class="row">
            <div class="col-xs-6 col-md-3" style="display:flex;justify-content:center">
                <a href="#" class="<?= $model->getImageUrl() == '/' . Yii::getAlias('@albumes') . '/disco.png' ? 'album' : 'disabled'?>">
                    <div>

                    </div>
                </a>

                <div style="display:none;">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($albumForm, 'imageFile')->fileInput(['style' => 'visibility: hidden', 'label' => 'none', 'class' => 'uploadAvatar'])->label(false) ?>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="col-xs-6 col-md-9">
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?> <small><?= Html::encode($model->anio) ?></small></h1>
                </div>
                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) : '' ?>
                    <?= Html::a('Añadir canción', ['canciones/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

                    <span style="float:right"><a href="<?=Url::to(['/reportes/create', 'url' => Yii::$app->request->absoluteUrl])?>">Reportar contenido</a></span>
                </p>
            </div>

      <!-- Table -->
      <table class="table">


      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'columns' => [
              [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:100px;'],
              ],
              [
               'label'=>'Canciones',
               'format' => 'raw',
               'value'=>function ($data) {
                   return Html::a(Html::encode($data['nombre']), ['/canciones/view', 'id' => $data['id']]);
               },
               ],
               [
                'format' => 'raw',
                'value' => function($data) {
                        return Html::a('Modificar canción', ['/canciones/update', 'id' => $data['id']], ['class' => 'btn-sm btn-primary']) . ' ' .
                        (Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('Eliminar canción', ['/canciones/delete', 'id' => $data['id']], [
                            'class' => 'btn-sm btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) : '');
                }
               ],
          //'created_at',
          ],
          'layout' => "{items}\n{pager}",
        ]) ?>
    </table>
    </div>

    <!--<h1><?= Html::encode($this->title) ?></h1> -->

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'id_artista',
            'nombre',
            'anio',
            'created_at',
        ],
    ]) ?>-->



</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<style type="text/css">

    .album div, .disabled div {
        background-image: url('<?= $model->getImageUrl()?>');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

</style>
