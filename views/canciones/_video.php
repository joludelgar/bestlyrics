<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cancion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-form' : 'btn btn-form']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
