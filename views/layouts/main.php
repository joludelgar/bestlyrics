<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\View;
use app\assets\AppAsset;
use app\assets\ScriptAsset;

ScriptAsset::register($this);

AppAsset::register($this);

$urlCanciones = Url::to(['/site/canciones']) . '?q=%QUERY';
$urlArtistas = Url::to(['/site/artistas']) . '?q=%QUERY';
$urlAlbumes = Url::to(['/site/albumes']) . '?q=%QUERY';
$artistasView = Url::to(['/artistas/view']) . '?id=';
$cancionesView = Url::to(['/canciones/view']) . '?id=';
$albumesView = Url::to(['/albumes/view']) . '?id=';

$js = <<<JS
var urlCanciones = "$urlCanciones";
var urlArtistas = "$urlArtistas";
var urlAlbumes = "$urlAlbumes";
var artistasView = "$artistasView";
var cancionesView = "$cancionesView";
var albumesView = "$albumesView";
JS;
$this->registerJs($js, View::POS_HEAD);
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
            '<li class="search"><form class="form-index row layout-search" method="GET" action="'.Url::to(['/site/search']).'">
                <div class="form-group search-form">
                    <input type="text" name="q" class="form-control typeahead" placeholder="Busca canciones, artistas o álbumes">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form></li>',
            ['label' => 'Inicio', 'url' => ['/site/index']],
            Yii::$app->user->isGuest ? '' : (Yii::$app->user->identity->isAdmin ? ['label' => 'Panel de administrador', 'url' => ['/site/admin']] : '') ,
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

<footer class="footer col-sm-12" itemscope itemtype="https://schema.org/LocalBusiness">
    <div class="container col-sm-offset-1 col-sm-7">
        <?= Html::img('@web/imagenes/bestlyrics.png', ['alt'=>Yii::$app->name, 'id' => 'logo', 'itemprop' => 'image']) ?>
        <p><span itemprop="name">Bestlyrics</span> nace con la intención de crear una gran comunidad de
            usuarios con una pasión en común, la música.</p>
        <p itemprop="description">Desde <span itemprop="name">Bestlyrics</span> te ofrecemos la oportunidad de compartir tus
            artistas, álbumes, canciones y letras favoritas para el disfrute
            de la comunidad y encontrar las letras de las canciones que más
            te gustan.</p>

        <p class="pull-left">&copy; Bestlyrics <?= date('Y') ?></p>
    </div>
    <div class="container col-sm-3" style="margin-top:20px">
        <p itemprop="founder">Jose Luis Delgado García</p>
        <p itemprop="address">Sanlúcar de Barrameda (Cádiz)</p>
        <p itemprop="email">Email de contacto: joludelgar@gmail.com</p>
        <p itemprop="url"><a href="https://www.bestlyrics.herokuapp.com">Bestlyrics</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
