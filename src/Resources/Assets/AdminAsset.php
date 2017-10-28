<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Admin backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        // 'static/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'static/bower_components/font-awesome/css/font-awesome.min.css',
        'static/bower_components/Ionicons/css/ionicons.min.css',
        'static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
        'static/dist/css/AdminLTE.min.css',
        'static/dist/css/skins/_all-skins.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ];
    public $js = [
        // 'static/bower_components/jquery/dist/jquery.min.js',
        'static/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'static/bower_components/datatables.net/js/jquery.dataTables.min.js',
        'static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'static/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'static/bower_components/fastclick/lib/fastclick.js',
        'static/dist/js/adminlte.min.js',
        // 'static/dist/js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
