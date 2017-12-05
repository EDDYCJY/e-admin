<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Admin backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $css = [
        'eadmin/css/site.css',
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ];

    public $js = [
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/datatables.net/js/jquery.dataTables.min.js',
        'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'bower_components/fastclick/lib/fastclick.js',
        'dist/js/adminlte.min.js',
        'eadmin/js/list.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $sourcePath = '@vendor/eddycjy/e-admin/src/Resources/Adminlte';

}
