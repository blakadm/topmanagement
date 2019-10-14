<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this \yii\web\View */
/* @var $content string */
$IsDeveloper= Yii::$app->user->can('Developer');
$IsWriter= Yii::$app->user->can('Writer');
?>

<header class="main-header" style="height: 40px!important;min-height: 40px">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid"> 
                <div class="nav-collapse">   
                    <?php
                    NavBar::begin([
                        'brandLabel' => '<img src="/images/onelab9.png" alt="" style="width: 130px;padding-top: 0px"/>',
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => 'navbar-blue navbar-fixed-top',
                            'style'=>'margin-top: -10px'
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                            ['label' => 'OneLab Portal', 'url' => ['/']],
                            ['label' => 'Top Management', 'url' => ['/toplevel', 'view' => 'about']],
                            ['label' => 'RBAC', 'icon' => 'circle-o', 'url' => ['/admin'],'visible' => (Yii::$app->user->can('Access-RBAC'))],
                            ['label' => 'Tools',
                                'items' => [
                                    ['label' => 'Articles', 'icon' => 'fa-newspaper-o', 'url' => ['/articles'],'visible'=>$IsWriter],
                                    ['label' => 'Documentation', 'icon' => 'fa fa-bookmark-o', 'url' => ['/help'],'visible'=>$IsDeveloper],
                                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],'visible'=>$IsDeveloper],
                                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],'visible'=>$IsDeveloper],
                                ],
                                'visible'=>!Yii::$app->user->isGuest,
                            ],
                            [
                                'label' => 'Login',
                                'url' => ['/admin/user/login'],
                                'visible' => Yii::$app->user->isGuest
                            ],
                            [
                                'label' => 'Logout',
                                'url' => ['/site/logout'],
                                'visible' => !Yii::$app->user->isGuest
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
