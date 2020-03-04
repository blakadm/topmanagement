<?php
use kartik\mpdf\Pdf;
use kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');
//$db = require(__DIR__ . '/db.php');
$components = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/components.php')
);
$config = [
    'id' => 'basic',
    'name' => 'OneLab Main Portal',
    'basePath' => dirname(__DIR__),
    //'bootstrap' => ['log'],
    'bootstrap' => ['log', 'maintenanceMode'],
    'timeZone' => 'asia/manila',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        // see settings on http://demos.krajee.com/grid#module
        ],
        'toplevel' => [//The Top Level Module
            'class' => 'app\modules\TopLevel',
        ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',
            // the global settings for the facebook plugins widget
            'facebook' => [
                'appId' => '2019616858321571',
                'app_secret' => '160f2b1b3203afccc84402b11cdf9dc9',
            ],
            // the global settings for the google plugins widget
            /* 'google' => [
              'clientId' => 'GOOGLE_API_CLIENT_ID',
              'pageId' => 'GOOGLE_PLUS_PAGE_ID',
              'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
              ],
              // the global settings for the disqus widget
              'disqus' => [
              'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
              ],
              // the global settings for the google analytic plugin widget
              'googleAnalytics' => [
              'id' => 'TRACKING_ID',
              'domain' => 'TRACKING_DOMAIN',
              ],
             */
            // the global settings for the twitter plugins widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'MM/dd/yyyy',
                Module::FORMAT_TIME => 'HH:mm:ss a',
                Module::FORMAT_DATETIME => 'MM/dd/yyyy HH:mm:ss a',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            // set your display timezone
            'displayTimezone' => 'Asia/Singapore',
            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class' => 'form-control'],
                    ]
                ]
            ]
        ],
        // Module Articles
        'articles' => [
            'class' => 'cinghie\articles\Articles',
            'userClass' => 'mdm\admin\models\User',
            // Select Languages allowed
            'languages' => [
                "it-IT" => "it-IT",
                "en-GB" => "en-GB"
            ],
            // Select Date Format
            'dateFormat' => 'd F Y',
            // Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
            'editor' => 'ckeditor',
            // Select Path To Upload Category Image
            'categoryImagePath' => '@webroot/img/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL' => '@web/img/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@webroot/img/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL' => '@web/img/articles/categories/thumb/',
            // Select Path To Upload Item Image
            'itemImagePath' => '@webroot/img/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL' => '@web/img/articles/items/',
            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@webroot/img/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL' => '@web/img/articles/items/thumb/',
            // Select Path To Upload Attachments
            'attachPath' => '@webroot/img/articles/items/',
           
            // Select URL To Upload Attachment
            'attachURL' => '/img/articles/items/',
            // Select Image Types allowed
            'attachType' => ['jpg', 'jpeg', 'gif', 'png', 'csv', 'pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx'],
            // Select Image Name: categoryname, original, casual
            'imageNameType' => 'categoryname',
            // Select Image Types allowed
            'imageType' => ['png', 'jpg', 'jpeg'],
            // Thumbnails Options
            'thumbOptions' => [
                'small' => ['quality' => 100, 'width' => 150, 'height' => 100],
                'medium' => ['quality' => 100, 'width' => 200, 'height' => 150],
                'large' => ['quality' => 100, 'width' => 300, 'height' => 250],
                'extra' => ['quality' => 100, 'width' => 400, 'height' => 350],
            ],
            // Show Titles in the views
            'showTitles' => true,
        ],
        // If you use tree table
        'treemanager' => [
            'class' => '\kartik\tree\Module',
        // see settings on http://demos.krajee.com/tree-manager#module
        ],
        'imagemanager' => [
            'class' => 'noam148\imagemanager\Module',
            //set accces rules ()
            'canUploadImage' => function() {
                return Yii::$app->user->can('ImageManager-UploadImage');
            },
            'canRemoveImage' => function() {
                //This will implement permission if user can delete image
                return Yii::$app->user->can('ImageManager-DeleteImage');
            },
            //add css files (to use in media manage selector iframe)
            'cssFiles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
            ],
        ],
    ], // End of Modules
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'gridview/export/*'
        ]
    ],
    'components' => $components,
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    //$config['modules']['debug'] = [
    //    'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    //];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
