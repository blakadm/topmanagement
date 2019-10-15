<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this \yii\web\View */
/* @var $content string */
$IsDeveloper= Yii::$app->user->can('Developer');
$IsWriter= Yii::$app->user->can('access-articles');
$IsAllowMaintenance=Yii::$app->user->can('Allow Maintenance');
if(Yii::$app->user->isGuest){
    $Username="";
}else{
    $Username="(".Yii::$app->user->identity->username.")";
}
?>
<header style="height: 40px!important;min-height: 40px">
    <div class="navbar navbar-inverse navbar-fixed-top fa-sign-out">
        <div class="navbar-inner">
            <div class="container-fluid"> 
                <div class="nav-collapse">   
                    <?php
                    NavBar::begin([
                        'brandLabel' => '<img src="/images/onelab9.png" alt="" style="width: 130px;padding-top: 0px"/>',
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => 'navbar-blue navbar-fixed-top',
                            'style' => 'margin-top: -10px'
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'encodeLabels' => false,
                        'items' => [
                            ['label' => 'Home', 'url' => [Yii::$app->homeUrl]],
                            ['label' => 'About', 'url' => ['/portal/about']],
                            ['label' => 'Members', 'url' => ['/portal/members']],
                            ['label' => 'Contact Us', 'url' => ['/portal/contact']],
                            ['label' => 'Performance Dashboard', 'url' => ['/toplevel']],
                            ['label' => 'External Links', 'icon' => 'users',
                                'items' => [
                                    [
                                        'label' => '<i class="fa fa-globe"></i> Referral',
                                        'url' => 'http://referral.onelab.ph',
                                        'linkOptions' => ['target' => '_blank']
                                    ],
                                    //Registered User
                                    [
                                        'label' => '<i class="fa fa-credit-card"></i> ePayment',
                                        'url' => 'https://payment.onelab.ph',
                                        'linkOptions' => ['target' => '_blank']
                                    ],
                                    [
                                        'label' => '<i class="fa fa-support"></i> Support',
                                        'url' => 'https://support.onelab.ph',
                                        'linkOptions' => ['target' => '_blank']
                                    ],
                                    
                                   
                                ]
                            ],
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
                                ]
                            ],
                        ],
                    ]);
                    NavBar::end();
                    ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</header>
