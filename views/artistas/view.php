<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Artista */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['ultimos']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/album.css');

$js = <<<JS
$('#artista').click(function(){
    $('input[type=file]').click();
    return false;
});

$(".upload").change(function() {
    this.form.submit();
})
JS;
$this->registerJs($js);
?>

    <div class="card">

      <div class="containerMenu">
              <a href="#" id="<?= $model->getImageUrl() == '/' . Yii::getAlias('@artistas') . '/example.jpg' ? 'artista' : 'disabled'?>">
                  <div class="cover">

                  </div>
                  <!--<?= Html::img($model->getImageUrl(), [
                      'alt' => 'cover',
                      'class' => 'cover',
                  ]) ?>-->
              </a>

              <div style="display:none;">


              <?php $form = ActiveForm::begin(); ?>

              <?= $form->field($artistaForm, 'imageFile')->fileInput(['style' => 'visibility: hidden', 'label' => 'none', 'class' => 'upload'])->label(false) ?>

              <?php ActiveForm::end(); ?>

              </div>

        <div class="hero">

          <div class="details">

            <div class="title1"><?= Html::encode($this->title) ?></div>

            <div class="title2"><?= Html::encode($model->biografia) ?></div>

          </div> <!-- end details -->

        </div> <!-- end hero -->

        <div class="description">

          <div class="column1">

              <hr>
              <p class="row">
              <?php $generos = [];
              foreach($model->albumes as $album) {
                  if (!in_array($album->idGenero->id, $generos)) {
                    array_push($generos, $album->idGenero->id);
                    ?><span class="tag"> <?= $album->idGenero->nombre ?> </span><?php
              } }?>
              </p>
                  <p>
                  <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                  </p>
                  <p>
                  <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('Eliminar', ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) : '' ?>
                  </p>

                  <p>
                  <span><a href="<?=Url::to(['/reportes/create', 'url' => Yii::$app->request->absoluteUrl])?>">Reportar contenido</a></span>
                  </p>
          </div> <!-- end column1 -->

          <div class="column2">

              <p style="float:right">
              <?= Html::a('Añadir nuevo álbum', ['albumes/create', 'id' => $model->id], ['class' => 'btn btn-personalizado']) ?>
              </p>

              <h3 id="albumes-title">Álbumes</h3>

              <div class="row">
                  <?= ListView::widget([
                  'dataProvider' => $dataProvider,
                  'itemOptions' => ['class' => 'item'],
                  'itemView' => '/albumes/viewMain',
                  'layout' => "{items}\n{pager}",
                  ]) ?>
              </div>



          </div> <!-- end column2 -->
        </div> <!-- end description -->


      </div> <!-- end container -->
    </div> <!-- end card -->

</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<style type="text/css">

    #artista div, #disabled div {
        background-image: url('<?= $model->getImageUrl()?>');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .hero::before {
        filter: blur(5px);
        background-size: cover;
    }

  .hero::before { <?= $model->getImageUrl() == '/' . Yii::getAlias('@artistas') . '/example.jpg' ?
       'background-color: #ff0050 !important' :
       'background-image: url('.$model->getImageUrl().'); background-repeat: no-repeat;' ?> }

</style>
