<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use kartik\mpdf\Pdf;

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'VTMsM2p-owNN76gSHT1QbShIDsTXWUb-',
    ],
    'maintenanceMode' => [
        // Component class namespace
        'class' => 'brussens\maintenance\MaintenanceMode',
        // Page title
        'title' => 'Under Maintenance!',
        // Mode status
        'enabled' => false,
        // Route to action
        'route' => 'maintenance/index',
        // Show message
        'message' => 'Sorry, we are updating the system. Please come back soon...',
        // Allowed role
       'roles' => [
            'Super-Administrator',
        ],
        'urls' => [
            'admin/user/login',
            'debug/default/toolbar',
            'debug/default/view',
            'dashboard/disable',
            'dashboard/enable',
        ],
        // Allowed IP addresses
        //'ips' => [
           // '127.0.0.1',
        //],
        // Layout path
         'layoutPath' => '@app/views/layouts/main.php',
        // View path
        'viewPath' => '@app/views/maintenance',
        // User name attribute name
        'usernameAttribute' => 'username',
        // HTTP Status Code
        'statusCode' => 503,
        //Retry-After header
        'retryAfter' => 120 //or Wed, 21 Oct 2015 07:28:00 GMT for example
    ],
    'curl' => [
        'class' => 'linslin\yii2\curl',
    ],
    'imagemanager' => [
        'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
        //set media path (outside the web folder is possible)
        'mediaPath' => '../media/imagemanager',
        //path relative web folder to store the cache images
        'cachePath' => 'assets/images',
        //use filename (seo friendly) for resized images else use a hash
        'useFilename' => true,
        //show full url (for example in case of a API)
        'absoluteUrl' => false,
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'authManager' => [
        'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        'defaultRoles' => ['Guest'],
    ],
    'assetManager' => [
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
            ],
        ],
    ],
    'user' => [
        //'class' => 'mdm\admin\models\User',
        'identityClass' => 'mdm\admin\models\User',
        'loginUrl' => ['admin/user/login'],
    ],
    'PostedData' => [
        'class' => 'app\components\GetData'
    ],
    'Functions' => [
        'class' => 'app\components\Functions'
    ],
    'pdf' => [
        'class' => Pdf::classname(),
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'destination' => Pdf::DEST_BROWSER,
    // refer settings section for all configuration options
    ],
    /* 'user' => [
      'identityClass' => 'app\models\User',
      'enableAutoLogin' => true,
      ],
     * 
     */
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                'sourceLanguage' => 'en',
                'fileMap' => [
                    //'main' => 'main.php',
                ],
            ],
        ],
    ],
    /*'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableStrictParsing' => false,
        'rules' => [
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ],
    ],
    */
    'urlManager' => [
        //'class' => 'yii\web\UrlManager',
        'class' => 'codemix\localeurls\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableLocaleUrls'=>false, //Turn Off Language
        'languages' => ['ua' => 'uk', 'en', 'ru'],
        'rules'=>require(__DIR__.'/_routes.php') // Load routes from PHP File
    ],
    'view' => [
        'theme' => [
            'pathMap' => [
                //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                '@app/views' => '@app/views'
            ],
        ],
    ],
];
