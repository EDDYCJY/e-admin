# yii-admin

Requirements
------------
 - PHP >= 5.6.0
 - YII >= 2.0

Installation
------------

一、Install yii advanced

二、Add yii database connection config
``` php
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=xxx',
    'username' => 'xxx',
    'password' => 'xxx',
    'tablePrefix' => 'xxx_',
    'charset' => 'utf8',
],
```
二、
``` bash
composer require eddycjy/e-admin
```

三、Create AdminController.php and add code on the yii console

``` php
<?php
namespace console\controllers;

class AdminController extends \yii\console\Controller
{
    public function actionInit()
    {
        \Eadmin\Start::init([]);
    }

    public function actionFlush()
    {
        \Eadmin\Start::flush([]);
    }

    public function actionDelete($name)
    {
        \Eadmin\Start::delete($name);
    }
}
```

四、Write a Model instance of the eadmin ( vendor/eddycjy/eadmin/src/Work/Model )

Yii Configuration
------------

一、Add Backend Config Path: $APP/backend/config/main.php

Add Config:

``` php
'on beforeAction' => ['Eadmin\Config', 'init'],
```

Demo:

```php
return [
    'id' => 'app-backend',
    'components' => [ ... ],
    ...
    'on beforeAction' => ['Eadmin\Config', 'init'],
    ...
];
```

二、Add Console Config Path: $APP/console/config/main.php

Add Config:

``` php
'session' => [ 
    'class' => 'yii\web\Session',
],
```

Demo:
``` php
return [
    ...
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'session' => [ 
            'class' => 'yii\web\Session',
        ],
    ],
    ...
];

```


Eadmin Configuration
------------

> Add Config Path: vendor/eddycjy/eadmin/src/Config

一、Set up website information: Setting.php

二、Set up Database: Database.php

三、Set up model Autoload: Autoload.php

Generate
------------

In the yii directory, run the following command to complete the generation

``` bash
./yii admin/init
```

if error, you can 

``` bash
./yii admin/flush 
```
or delete specified options (support modelName and runtime catalogName )

``` bash
./yii admin/delete [options]
```

Other
------------
- [Yii](https://github.com/yiisoft/yii2)
- [AdminLTE](https://github.com/almasaeed2010/AdminLTE)
- [Yii2-ueditor](https://github.com/EDDYCJY/yii2-ueditor)
- [Yii2-iconpicker](https://github.com/EDDYCJY/yii2-iconpicker)
- [Yii2-widget-fileinput](https://github.com/kartik-v/yii2-widget-fileinput)
- [Yii2-widget-datepicker](https://github.com/kartik-v/yii2-widget-datepicker)
- [Yii2-dual-listbox](https://github.com/softark/yii2-dual-listbox)
- [Yii2-phpexcel](https://github.com/moonlandsoft/yii2-phpexcel)
- [PHPexcel](https://github.com/PHPOffice/PHPExcel)

License
------------

MIT