<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/imagenes/bestlyrics2.png', ['alt'=>Yii::$app->name, 'id' => 'logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            Yii::$app->user->isGuest ? '' : ['label' => 'Panel de administrador', 'url' => ['/site/admin']],
            ['label' => 'Artistas', 'url' => ['/artistas/ultimos']],
            Yii::$app->user->isGuest ?
            ['label' => 'Iniciar sesión', 'url' => ['/user/security/login']] :
            [
                'label' => Html::img(Yii::$app->user->identity->profile->getImageUrl(), ['class' => 'img-circle']) . ' ' . Yii::$app->user->identity->username,
                'url' => ['usuarios/index'],
                'encode' => false,
                'items' =>
                [
                    ['label' => 'Ver perfil', 'url' => ['/user/profile/show', 'id' => Yii::$app->user->identity->id]],
                    ['label' => 'Editar perfil', 'url' => ['/user/settings/profile']],
                    ['label' => 'Cerrar sesión',
                        'url' => ['/user/security/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ]
            ],
            ['label' => 'Registrarse', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Bestlyrics <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
