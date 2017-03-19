<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/font-awesome.min.css',
        'css/main.css',
        'css/prettyPhoto.css',
        'css/price-range.css',
        'css/responsive.css',
        '//fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700,100',
        '//fonts.googleapis.com/css?family=Open+Sans:400,800,300,600,700',
        '//fonts.googleapis.com/css?family=Abel'
    ];
    public $js = [
        'js/contact.js',
        'js/gmaps.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery.scrollUp.min.js',
        'js/main.js',
        'js/price-range.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
