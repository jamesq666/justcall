<?php

use app\assets\FeedbackPageAsset;
use app\assets\Html2CanvasAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

Html2CanvasAsset::register($this);
FeedbackPageAsset::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'feedback-form']); ?>
<div id="canvas">
    <?= Html::submitButton('Сделать скриншот', ['class' => 'btn btn-primary', 'id' => 'screenshot']) ?>
</div>
<div id="out_image">
</div>
<?php ActiveForm::end(); ?>
