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
use yii\widgets\ListView;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->registerJsFile('@web/js/profile.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<div class="row profile-user-show">
    <div class="col-xs-12 col-sm-12 col-md-12 profile-show">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 avatar-profile">
            <div class="avatar">
                <?= Html::img($profile->getImageUrl(), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => $profile->user->username,
                ]) ?>
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 section-datos" id="profile-datos">
                <h3><?= Html::a($profile->user->username, ['/user/profile/show', 'id' => $profile->user->id]) ?></h3>
                <h4><?= $this->title ?></h4>
                <ul class="lista-datos">
                    <?php if (!empty($profile->location)): ?>
                        <li>
                            <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->website)): ?>
                        <li>
                            <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->public_email)): ?>
                        <li>
                            <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                        </li>
                    <?php endif; ?>
                    <li>
                        <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                    </li>
                </ul>
                <?php if (!empty($profile->bio)): ?>
                    <p><?= Html::encode($profile->bio) ?></p>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 favoritos-user">
        <div class="color-change">
            <input type="color" id="color" name="color" value="#222" data-toggle = "tooltip" data-placement = "left" title = "Cambiar color de la vista de los perfiles">
        </div>
   <ul class="nav nav-tabs" role="tablist">
     <li role="presentation" class="active"><a href="#favoritos" aria-controls="favoritos" role="tab" data-toggle="tab">Favoritos</a></li>
     <li role="presentation"><a href="#anadidas" aria-controls="anadidas" role="tab" data-toggle="tab">Historial de letras añadidas/modificadas</a></li>
   </ul>

   <!-- Tab panes -->
   <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="favoritos"></br>
         <div class="row">
             <?= ListView::widget([
             'dataProvider' => $dataProvider,
             'itemOptions' => ['class' => 'item'],
             'itemView' => '@app/views/letras/profile',
             'layout' => "{items}\n{pager}",
             ]) ?>
         </div>
     </div>
     <div role="tabpanel" class="tab-pane" id="anadidas"></br>
         <div class="row">
             <?= ListView::widget([
             'dataProvider' => $dataProvider2,
             'itemOptions' => ['class' => 'item'],
             'itemView' => '@app/views/letras/profile2',
             'layout' => "{items}\n{pager}",
             ]) ?>
         </div>
     </div>
   </div>
   </div>
</div>
