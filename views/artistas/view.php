<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Artista */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Artistas', 'url' => ['ultimos']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/album.css');
$this->registerJsFile('@web/js/artista.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

    <div class="card">

      <div class="containerMenu">
              <a href="#" id="<?= $model->getImageUrl() == '/' . Yii::getAlias('@artistas') . '/example.jpg' ? 'artista' : 'disabled'?>">
                  <div class="cover">

                  </div>
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
              <p>
                  <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Eliminar imagen', ['delete-imagen', 'id' => $model->id], [
                      'class' => 'btn btn-xs btn-danger',
                      'data' => [
                          'confirm' => '¿Estás seguro?',
                          'method' => 'post',
                      ],
                  ]) : '' ?>
              </p>
              <hr>
              <p class="row">
              <?php $generos = [];
              foreach($model->albumes as $album) {
                  if (!in_array($album->idGenero->id, $generos)) {
                    array_push($generos, $album->idGenero->id);
                    ?><span class="tag"><?= Html::a( $album->idGenero->nombre , ['/generos/view', 'id' => $album->idGenero->id], ['class' => 'enlace-tag']) ?></span><?php
              } }?>
              </p>
                  <p>
                  <?= Html::a('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-oculto']) ?>

                  <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->isAdmin ? Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar', ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger btn-oculto',
                      'data' => [
                          'confirm' => '¿Estás seguro?',
                          'method' => 'post',
                      ],
                  ]) : '' ?>
                  </p>

                  <p>
                      <?php
                       if (!Yii::$app->user->isGuest) {
                          Modal::begin([
                              'toggleButton' => [
                                  'label' => 'Reportar contenido',
                                  'class' => 'btn btn-link reporte'
                              ],
                              'closeButton' => [
                                'label' => 'Cerrar',
                                'class' => 'btn btn-danger btn-sm pull-right',
                              ],
                              'size' => 'modal-lg',
                          ]);

                          echo $render;

                          Modal::end();
                      };
                      ?>
                  </p>
          </div> <!-- end column1 -->

          <div class="column2">

              <p style="float:right" class="btn-ultimos">
              <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Añadir nuevo álbum', ['albumes/create', 'id' => $model->id], ['class' => 'btn btn-personalizado']) ?>
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
