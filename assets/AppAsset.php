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
    //public $sourcePath = '@bower/admin-lte';
    public $css = [
        //'css/reset.css',
        'css/site.css',
        'css/chart-overlay.css',
        'css/bower_components/Ionicons/css/ionicons.min.css',
        '/css/hexagongrid.css',
        '/css/tracking.css',
        '/css/breadcrumbs.css',
        '/css/toggleswitch.css',
    ];
    public $js = [
        '/js/bootbox.min.js',
        '/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
