<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
$IsDeveloper = Yii::$app->user->can('Developer');
$IsWriter = Yii::$app->user->can('access-articles');
$IsAllowMaintenance = Yii::$app->user->can('Allow Maintenance');
if (Yii::$app->user->isGuest) {
    $Username = "";
} else {
    $Username = "(" . Yii::$app->user->identity->username . ")";
}
?>

<style type="text/css">
    .menu-main-bg {
        width: 100%;
        height: auto;
        float: left;
        background-color: #066da9;
        padding: 0% 0%;
        top: auto !important;
    
    } 
    
    .navbar-default{
  border: none;
  border-radius: 0;
}
.wrap{
    background-color: white;
}
.main-footer{
    background-color: #024a74;
}

.nav-pills > li > a {
    border-radius: 0;
    border-top: 3px solid 
transparent;
color:
    #fff;
}

.nav-tabs>li>a:hover {
    border-bottom-color:#fff;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    border-top-color:#024a74 !important;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    border-top-color: #024a74 !important;
  
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover {
    border-top-color:#024a74 !important;
}

.nav-pills > a, .nav-pills > a:hover {
    border-top-color:#024a74 !important;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #fff;
    background-color: #024a74;
}

.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
    color: #fff;
    background: #0B7CBE !important;
}



</style>

<header>
    
            <main style="background-color: #ecf0f5 !important;padding-bottom: 42px;"/>
            <div style="background-color: #ecf0f5 !important;">
                <div class="container">
                    <div class="row" style="margin-top:1%">
                        <div class="col-xs-6 col-md-6">
                            <div class="logo-bg">
                                <img src="/images/dostlogonew.png" style ="border-radius: 5px"  class="pull-left img-responsive"/>
                            </div>

                        </div>

                        <div class="col-xs-6 col-md-6">
                            <div class="logo-bg2">
                                <img src="/images/onelabblue.png"  style ="border-radius: 5px" class="pull-right img-responsive"/>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!----------------------menu start--------------------->

            <br>
            <div class="col-xs-12 col-md-12" style="padding:0px; margin:0px;">



                <nav class="navbar-default menu-main-bg">
                    <div class="container-fluid">
                        <?php
                    NavBar::begin([
                      //  'brandLabel' => '<img src="/images/onelab9.png" alt="" style="width: 130px;padding-top: 0px"/>',
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                         //   'class' => 'navbar',
                           // 'style' => 'margin-top: -10px'
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-pills nav-justified'],
                        'encodeLabels' => false,
                        'items' => [
                            ['label' => 'Home', 'url' => [Yii::$app->homeUrl]],
                            ['label' => 'News', 'url' => ['/portal/newsfeed']],
                            ['label' => 'Our Network', 'url' => ['/portal/network']],
                            ['label' => 'Services', 'url' => ['/portal/services']],
                            ['label' => 'Be a MEMBER', 'url' => ['/portal/newmembers']],
                            ['label' => 'Performance Dashboard', 'url' => ['/toplevel']],
//                            ['label' => 'External Links', 'icon' => 'users',
//                                'items' => [
//                                    [
//                                        'label' => '<i class="fa fa-globe"></i> Referral',
//                                        'url' => 'http://referral.onelab.ph',
//                                        'linkOptions' => ['target' => '_blank']
//                                    ],
//                                    //Registered User
//                                    [
//                                        'label' => '<i class="fa fa-credit-card"></i> ePayment',
//                                        'url' => 'https://payment.onelab.ph',
//                                        'linkOptions' => ['target' => '_blank']
//                                    ],
//                                    [
//                                        'label' => '<i class="fa fa-support"></i> Support',
//                                        'url' => 'https://support.onelab.ph',
//                                        'linkOptions' => ['target' => '_blank']
//                                    ],
//                                    
//                                   
//                                ]
//                            ],
                            ['label' => 'Account', 'icon' => 'users',
                                'items' => [
                                    
                                    ['label' => 'Separator', 'url' => '#', 'options' => ['class' => 'divider', 'visible' => $IsDeveloper]],
                                    ['label' => '<i class="fa fa-bookmark-o"></i> Articles', 'icon' => 'fa-newspaper-o', 'url' => ['/articles'], 'visible' => $IsWriter],
                                    ['label' => '<i class="fa fa-paragraph"></i> Documentation', 'icon' => 'fa fa-bookmark-o', 'url' => ['/help'], 'visible' => $IsDeveloper],
                                    ['label' => '<i class="fa fa-cog"></i> System Settings', 'icon' => 'fa fa-server', 'url' => ['/settings'], 'visible' => $IsDeveloper],
                                    ['label' => 'Separator', 'url' => '#', 'options' => ['class' => 'divider'], 'visible' => $IsDeveloper],
                                    ['label' => '<i class="fa fa-gg"></i> Gii', 'icon' => 'file-code-o', 'url' => ['/gii'], 'visible' => $IsDeveloper],
                                    ['label' => '<i class="fa fa-bug"></i> Debug', 'icon' => 'dashboard', 'url' => ['/debug'], 'visible' => $IsDeveloper],
                                    ['label' => 'Separator', 'url' => '#', 'options' => ['class' => 'divider'], 'visible' => $IsDeveloper],
                                  //  [
                                  //      'label' => '<i class="fa fa-user-times"></i> Roles & Permissions',
                                 //       'url' => ['/site/roles'],
                                 //       'visible' => !Yii::$app->user->isGuest
                                 //   ],
                                  // [
                                  //      'label' => '<i class="fa fa-cog"></i> RBAC',
                                 //       'url' => ['/admin'],
                                 //       'visible' => !Yii::$app->user->isGuest
                                 //   ],
                                    [
                                        'label' => '<i class="fa fa-sign-in"></i> Login',
                                        'url' => ['/admin/user/login'],
                                        'visible' => Yii::$app->user->isGuest
                                    ],
                                    //Registered User
                                    [
                                        'label' => '<i class="fa fa-sign-out"></i> Logout' . $Username,
                                        'url' => ['/site/logout'],
                                        'visible' => !Yii::$app->user->isGuest
                                    ],
                                    [
                                        'label' => '<i class="fa fa-sign-out"></i> Change Password' . $Username,
                                        'url' => ['/admin/user/change-password'],
                                        'visible' => !Yii::$app->user->isGuest
                                    ],
                                ]
                            ],
                        ],
                    ]);
                    NavBar::end();
                    ?>
                    </div>

                </nav>
                <br />
            </div>
    </div>
  
</header>
