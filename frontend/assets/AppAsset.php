<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'macgyer\yii2materializecss\assets\MaterializePluginAsset',
        'macgyer\yii2materializecss\assets\MaterializeAsset',
        'macgyer\yii2materializecss\assets\MaterializeFontAsset',
        //'macgyer\yii2materializecss\assets\NoUiSliderAsset',
        'frontend\assets\MaterializeInitAsset',

    ];
}
