<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MyBootstrapAsset extends AssetBundle
{
    public $sourcePath = null;
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/';
    public $js = [
        YII_ENV_PROD ? 'popper.js@1.12.9/dist/umd/popper.min.js' : 'popper.js@1.12.9/dist/umd/popper.js',
        YII_ENV_PROD ? 'bootstrap@4.0.0/dist/js/bootstrap.min.js' : 'bootstrap@4.0.0/dist/js/bootstrap.js'

    ];
    public $publishOptions = [
        'only' => [
            'fonts/*',
            'css/*',
        ]
    ];

    public function init()
    {
        $this->jsOptions['position'] = View::POS_BEGIN;
        parent::init();
    }
}
