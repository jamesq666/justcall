<?php

namespace app\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/jQuery';

    public $js = [
        'js/jquery-3.7.0.min.js',
    ];
}