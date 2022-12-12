<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MyjQueryAsset extends AssetBundle
{
    public $sourcePath = null;
    public $baseUrl = 'https://code.jquery.com';
    public $js = [
        YII_ENV_PROD ? 'jquery-3.6.1.min.js' : 'jquery-3.6.1.js'
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
