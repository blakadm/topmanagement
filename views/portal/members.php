<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Agency;

$Agencies = Agency::find()->orderBy(['agency_name' => SORT_ASC])->all();
$SQL="SELECT `agency_name` AS `name`,`website`, `description`, `membertypeid` 
FROM `tbl_agency` WHERE `membertypeid`=1 GROUP BY `r_id` ORDER BY `r_id`";
$Connection=Yii::$app->db;
$Command=$Connection->createCommand($SQL);
$mAgencies=$Command->queryAll();
$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .link-display {
        display: block;
        position: relative;
    }
    a {
        color: #000;
    }

    .div_ex
    {
        box-shadow: none;
        transition: .5s ease;
        background: transparent;
    }
    .div_ex:hover
    {

        box-shadow: 0 0 0 3px #3c8dbc;
        transition: .5s ease;


    }

    .hasTooltip {
        position:relative;
    }
    .hasTooltip span {
        display:none;
    }

    .hasTooltip:hover{
        color: #BEBEBE;
    }

    .hasTooltip:hover span {
        display:block;
        background-color:#3c8dbc;
        border-radius:5px;
        color:#fff;
        border:1px solid #bebebe;
        position:absolute;
        padding:5px;
        top:1.3em;
        left:0px;

        width:300px;
        z-index: 1000;
        /* I don't want the width to be too large... */
    }



</style>

<div class="members" style="margin: 1%">
    <div class="note-box rounded">
        <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
        <h3 class="alert alert-info">OneLab Member Laboratories</h3>
        <div class="content-items" style="margin:15px">
            <div class="content-items">
                <p style="margin-top: 10px">
                    <span class="btn btn-primary"><span class="badge">DOST </span>  Regional Standards and Testing Laboratories</span>
                </p>
                <?php
                foreach ($mAgencies as $mAgency) {
                    $mAgency=(object)$mAgency;
                    if ($mAgency->membertypeid == 1) {
                        echo '<div class="" style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                        echo '<a href="' . $mAgency->website . '"' . ' title="' . $mAgency->description . ' (' . $mAgency->website . ') "' . ' class="hasTooltip"  target="_blank"><img style="border:none;display:block;margin:top:0;margin-left:auto;margin-right: auto;" class="customer-logo" src="/images/members/dost.jpg">';
                        echo '<label>' . $mAgency->name . '</label>' . PHP_EOL;
                        echo '<span>' . $mAgency->description . ' (' . $mAgency->website . ')' . ' </span>' . PHP_EOL;
                        echo '</a></div>' . PHP_EOL;
                    }
                }
                ?>
                <p style="margin-top: 10px">
                    <button class="btn btn-primary"><span class="badge">DOST </span> Research and Development Institutes</button>
                </p>
                <?php
                foreach ($Agencies as $Agency) {
                    if ($Agency->membertypeid == 2) {
                        echo '<div class="" style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                        echo '<a href="' . $Agency->website . '"' . ' title="' . $Agency->description . ' (' . $Agency->website . ') "' . ' class="hasTooltip" target="_blank"><img style="border:none;display:block;margin:top:0;margin-left:auto;margin-right: auto;" class="customer-logo"' . 'src="/images/members/' . strtolower($Agency->code) . '.png">';
                        echo '<label>' . $Agency->name . '</label>' . PHP_EOL;
                        echo '<span>' . $Agency->description . ' (' . $Agency->website . ')' . ' </span>' . PHP_EOL;
                        echo '</a></div>' . PHP_EOL;
                    }
                }
                ?>
                <p style="margin-top: 10px">
                    <button class="btn btn-primary"><span class="badge">Other </span> Government Agencies</button>
                </p>
                <?php
                foreach ($Agencies as $Agency) {
                    if ($Agency->membertypeid == 4) {
                        echo '<div class="" style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                        echo '<a href="' . $Agency->website . '"' . ' title="' . $Agency->description . ' (' . $Agency->website . ') "' . ' class="hasTooltip" target="_blank"><img style="border:none;display:block;margin:top:0;margin-left:auto;margin-right: auto;" class="customer-logo"' . 'src="/images/members/' . strtolower($Agency->code) . '.png">';
                        echo '<label style="width:100px">' . $Agency->agency_name . '</label>' . PHP_EOL;
                        echo '<span>' . $Agency->description . ' (' . $Agency->website . ')' . ' </span>' . PHP_EOL;
                        echo '</a></div>' . PHP_EOL;
                    }
                }
                ?>
                <p style="margin-top: 10px">
                    <button class="btn btn-primary"><span class="badge">Private</span> Laboratories</button>
                </p>
                <?php
                foreach ($Agencies as $Agency) {
                    if ($Agency->membertypeid == 3) {
                        echo '<div class="" style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                        echo '<a href="' . $Agency->website . '"' . ' title="' . $Agency->description . ' (' . $Agency->website . ') "' . ' class="hasTooltip" target="_blank"><img style="border:none;display:block;margin:top:0;margin-left:auto;margin-right: auto;" class="customer-logo"' . 'src="/images/members/' . strtolower($Agency->code) . '.png">';
                        echo '<label style="width:100px">' . $Agency->agency_name . '</label>' . PHP_EOL;
                        echo '<span>' . $Agency->description . ' (' . $Agency->website . ')' . ' </span>' . PHP_EOL;
                        echo '</a></div>' . PHP_EOL;
                    }
                }
                ?>
                <div style="height: 30px"></div>
            </div>

        </div>
    </div>  <!--end of notebox-rounded-->
</div>