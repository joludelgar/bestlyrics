<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Letra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-xs-12 col-md-8">
    <div class="letra-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $model->isNewRecord ? $form->field($model, 'id_idioma')->dropDownList($idiomas,
            ['prompt' => 'Selecciona el idioma...']
        ) : '' ?>

        <?= $form->field($model, 'letra')->textarea(['rows' => '25', 'maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-personalizado' : 'btn btn-personalizado']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
  </div>
  <div class="col-xs-12 col-md-4">
      <h2>Reglas de escritura</h2>
      <hr>
      <ol>
          <li>Comentarios como "intro", "verso", "puente", "coro", "outro", "hablado", etc... deben ser reemplazados por una fila vacía.</li>
          <li>Comentarios como "repetir 2 veces", "repetir coro o verso", etc... deben ser eliminados y la parte de la letra involucrada debe repetirse en consecuencia.</li>
          <li>Todas las partes no habladas como "Ohh", "Ahaaha", "NaNaNa", etc... deben ser mostrados sólo si es parte esencial de la letra.</li>
          <li>Los nombres de los intérpretes dentro de las letras deben ser evitados / eliminados, incluso cuando se indica una parte específica cantada por el artista.</li>
      </ol>
      <hr>
      <h3>Estilo de escritura</h3>
      <ol>
          <li>Por favor recuerde cuidar de corregir caracteres / palabras acentuadas no corregidas.</li>
          <li>Los nombres propios (de personas, lugares, o ciertas cosas especiales) deben ser mayúsculas.</li>
      </ol>
      <hr>
      <h3>Reglas de puntuación</h3>
      <ol>
          <li>No utilice *** o ===, ---</li>
          <li>Tenga cuidado de las reglas básicas de puntuación.</li>
      </ol>
  </div>
</div>
