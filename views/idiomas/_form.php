<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Idioma */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="idioma-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-form' : 'btn btn-form']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
