<?php use yii\helpers\Html;  ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
        $menuItems[] = ''
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                        '<button class="btn bg-blue-gradient">Logout</button>', ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '';
        ?>
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'Announcement', 'icon' => 'file-code-o', 'url' => ['/announcement'], 'visible' => Yii::$app->user->can('Access-Announcement')],
                        ['label' => 'Permission', 'icon' => 'circle-o', 'url' => ['/admin'], 'visible' => (Yii::$app->user->can('Access-RBAC'))],
                        ['label' => 'Login', 'icon' => 'fa fa-user-o', 'url' => ['admin/user/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Logout', 'icon' => 'fa fa-user-o', 'url' => ['/site/logout'], 'visible' => !Yii::$app->user->isGuest],
                        [
                            'label' => 'Developer Tools',
                            'icon' => 'share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Documentation', 'icon' => 'fa fa-bookmark-o', 'url' => ['/help'],],
                                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                                ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            ],
                            'visible' => (Yii::$app->user->can('Developer')),
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
