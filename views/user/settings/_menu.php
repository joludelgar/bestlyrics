<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\ActiveForm;
/**
 * @var dektrium\user\models\User $user
 */
$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;

$this->registerJsFile('@web/js/tooltips.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/avatar.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::img($user->profile->getImageUrl(), [
                'class' => 'img-rounded',
                'alt' => $user->username,
                'style' => 'height:30px;width:30px;',
            ]) ?>
            <?= $user->username ?>
        </h3>
    </div>

    <div class="panel-body">
        <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
                ['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
            ],
        ]) ?>
    </div>

    <div class="panel-heading">
        <h3 class="panel-title">Avatar<span class="glyphicon glyphicon-info-sign float-right" aria-hidden="true" data-toggle = "tooltip" data-placement = "left" title = "Haz click en la imagen, escoge una y haz click en Guardar"></span></h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'account-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                'labelOptions' => ['class' => 'col-lg-3 control-label'],
            ],
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
        ]); ?>

        <a href="#" class="thumbnail" id="avatar">
            <?= Html::img($user->profile->getImageUrl(), [
                'alt' => $user->username,
            ]) ?>
        </a>

        <div class="desactivado" style="display:none;">
            <?= $form->field($model, 'imageFile')->fileInput() ?>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-personalizado']) ?><br>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
