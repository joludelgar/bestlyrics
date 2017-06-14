<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Favorito;

/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

$this->registerJsFile('@web/js/yt.js');
$this->registerCssFile('@web/css/full.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

?>
<div class="volver">
    <?= Html::a('',['/canciones/view', 'id' => $model->id],[
            'class' => 'btn btn-lg glyphicon glyphicon-circle-arrow-left'
        ]
        );?>
</div>
<div class="cancion-full-view">

    <div id="overflowContainer" style="">
        <iframe id="videoBackground" src="//www.youtube.com/embed/<?=substr($model->video, strpos($model->video, '=')+1, 11)?>?feature=player_embedded&autoplay=1&controls=0&loop=1&modestbranding=1&rel=0&showinfo=0&disablekb=1&enablejsapi=1&iv_load_policy=3" frameborder="0" allowfullscreen="false"></iframe>
    </div>

    <div class="bodyContent" id="scroll">
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?= $model->letras == null ? '' : nl2br($model->letraOriginal->letra) ?>
        <br><br><br><br><br><br>
    </div>


</div>
