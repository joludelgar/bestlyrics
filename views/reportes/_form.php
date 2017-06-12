<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Mandar reporte' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-personalizado' : 'btn btn-personalizado']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
