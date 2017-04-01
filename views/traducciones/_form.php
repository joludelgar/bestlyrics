<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Traduccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traduccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cancion')->textInput() ?>

    <?= $form->field($model, 'id_idioma')->textInput() ?>

    <?= $form->field($model, 'bloqueada')->checkbox() ?>

    <?= $form->field($model, 'letra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>