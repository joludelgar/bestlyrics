<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlbumGenero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-genero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_album')->textInput() ?>

    <?= $form->field($model, 'id_genero')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
