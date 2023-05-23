<?php

namespace app\assets;

use yii\web\AssetBundle;

class FeedbackPageAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/feedbackPage';

    public $js = [
        'js/feedbackPage.js',
    ];

    public $depends = [
        JqueryAsset::class,
        Html2CanvasAsset::class,
    ];
}