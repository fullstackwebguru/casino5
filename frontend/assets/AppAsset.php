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
        'css/bootstrap.min.css',
        'css/reset.css',
        'css/style.css',
        'css/bootstrap-sortable.css'
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.js',
        'js/bootstrap-sortable.js',
        'js/moment.js',
        'js/main.js',
        'js/main-1.js',
        'js/masonry.pkgd.min.js',
        'js/jquery.flexslider-min.js',
        'js/modernizr.js',
        'js/jquery.ui.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
