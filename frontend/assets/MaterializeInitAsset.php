<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Initialization of Materialize javascript
 */
class MaterializeInitAsset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files for this asset bundle.
     */
    public $sourcePath = '@bower/materialize';

    public $css = [];
    public $js = [
        'js/init.js'
    ];
    public $depends = [
    'macgyer\yii2materializecss\assets\MaterializePluginAsset',
    ];
}
