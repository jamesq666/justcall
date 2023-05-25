<?php

use app\assets\FeedbackPageAsset;
use app\assets\Html2CanvasAsset;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

Html2CanvasAsset::register($this);
FeedbackPageAsset::register($this);
?>

<?= Html::button('Сделать скриншот', ['class' => 'btn btn-danger', 'id' => 'screenshot', 'style' => 'margin-top:400px; margin-left: 550px;']) ?>
<div id="feedback">
</div>
