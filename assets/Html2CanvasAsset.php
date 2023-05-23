<?php

namespace app\assets;

use yii\web\AssetBundle;

class Html2CanvasAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/html2canvas';

    public $js = [
        'js/html2canvas.min.js',
    ];
}