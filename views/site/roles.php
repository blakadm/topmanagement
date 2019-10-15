<?php
use yii\jui\Accordion;
/* 
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2017 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 12 18, 17 , 1:57:08 PM * 
 * Module: roles * 
 */

$this->title = Yii::t('Site', 'Roles & Permissions');
$this->params['breadcrumbs'][] = $this->title;
$StartHeader = false;
$Permissions = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
$RouteList='';
$PermissionsList='';
foreach ($Permissions as $Permission) {
    if (substr($Permission->name, 0, 1) == '/') {
        if (!$StartHeader) {
            $PermissionsList="<h4>Routes</h4>";
            $PermissionsList.="<ul id='nRoute'>" . PHP_EOL;
            $StartHeader = true;
        }
        $PermissionsList.="<li>" . $Permission->name . "</li>";
    } else {
        if ($StartHeader) {
            $PermissionsList.="</ul>" . PHP_EOL;
            $PermissionsList.="<h4>Permissions</h4>";
            $PermissionsList.="<ul id='nPermission'>" . PHP_EOL;
            $StartHeader = false;
        }
        $PermissionsList.="<li>" . $Permission->name . "</li>";
    }
}
$PermissionsList.="</ul>" . PHP_EOL;
$MyRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
$RouteList="<ul>".PHP_EOL;
foreach ($MyRoles as $Role) {
    $RouteList.="<li class=''>" . $Role->name . "</li>";
}
$RouteList.="</ul>".PHP_EOL;
?>
<div class="articles-default-index">
    <div class="panel panel-default">
        <div class="panel-heading"><i class='fa fa-user-circle-o'></i> My Roles & Permissions</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                <?php
                echo Accordion::widget([
                    'items' => [
                        [
                            'header' => 'Roles',
                            'content' => $RouteList,
                        ],
                        [
                            'header' => 'Permissions',
                            'headerOptions' => ['tag' => 'h3'],
                            'content' => $PermissionsList,
                            'options' => ['tag' => 'div'],
                        ],
                    ],
                    'options' => ['tag' => 'div'],
                    'itemOptions' => ['tag' => 'div'],
                    'headerOptions' => ['tag' => 'h3'],
                    'clientOptions' => ['collapsible' => true,'active'=>false],
                ]);
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
