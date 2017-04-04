<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Letra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'letra')->textarea(['rows' => '20', 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
