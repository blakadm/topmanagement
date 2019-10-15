<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Agency;

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
$Agencies= Agency::find()->orderBy(['ordernumber'=>SORT_ASC])->all();

?>

<div class="content-items">
    <span style="font-size: 24px;font-weight: bold">OneLab Members</span>
    <p style="margin-top: 10px">
        <button class="btn btn-primary"><span class="badge">DOST </span>  Regional Standards and Testing Laboratories</button>
    </p>
    <?php
        foreach($Agencies as $Agency){
            if($Agency->membertypeid==1){
                echo '<span class="span-display">'.PHP_EOL;
                echo '<a href="'.$Agency->website.'" class="link-display" target="_blank"><img class="customer-logo" title="'.$Agency->name.'" src="/images/members/dost.jpg"></a>';
                echo '<label>'.$Agency->name.'</label>'.PHP_EOL;
                echo '</span>'.PHP_EOL;
            }
        }
    ?>
    <p style="margin-top: 10px">
        <button class="btn btn-primary"><span class="badge">DOST </span> Research and Development Institutes</button>
    </p> 
    <?php
        foreach($Agencies as $Agency){
            if($Agency->membertypeid==2){
                echo '<span class="span-display">'.PHP_EOL;
                echo '<a href="'.$Agency->website.'" class="link-display" target="_blank"><img class="customer-logo" title="'.$Agency->description.'" src="/images/members/'.strtolower($Agency->code).'.png"></a>';
                echo '<label>'.$Agency->name.'</label>'.PHP_EOL;
                echo '</span>'.PHP_EOL;
            }
        }
    ?>
    <div class="row">
    <div class="col-lg-6">
    <p style="margin-top: 10px">
        <button class="btn btn-primary"><span class="badge">Other </span> Government Agencies</button>
    </p> 
    <div class="row" style="padding-left: 30px">
    <ul class="table-hover" style="list-style: none">
    <?php
        foreach($Agencies as $Agency){
            if($Agency->membertypeid==3){
                echo '<li style="color: black">'.PHP_EOL;
                echo '<a href="'.$Agency->website.'" class="link-display" target="_blank"><img class="customer-logo" title="'.$Agency->description.'" src="/images/members/'.strtolower($Agency->code).'.png">';
                echo '<br>'.$Agency->name;
                echo '<br>'.$Agency->website;
                echo '</a></li>'.PHP_EOL;
            }
        }
    ?>
    </ul>
    </div>
    </div>
    <div class="col-lg-6">
    <p style="margin-top: 10px">
        <button class="btn btn-primary"><span class="badge">Private</span> Laboratories</button>
    </p> 
    <div class="row" style="padding-left: 30px">
    <ul class="table-hover">
    <?php
        foreach($Agencies as $Agency){
            if($Agency->membertypeid==4){
                echo '<li style="color: black">'.PHP_EOL;
                echo '<a href="'.$Agency->website.'" class="link-display" target="_blank"><img class="customer-logo" title="'.$Agency->description.'" width="5px" src="/images/members/'.strtolower($Agency->code).'.png">';
                echo '<br>'.$Agency->name;
                echo '<br>'.$Agency->website;
                echo '</a></li>'.PHP_EOL;
            }
        }
    ?>
    </ul>
    </div>
    </div>
    </div>
</div>
