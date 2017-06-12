<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Artista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artista-form">

    <hr>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'biografia')->textarea(['rows' => 6, 'maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-form' : 'btn btn-form']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
