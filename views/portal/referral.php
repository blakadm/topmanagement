<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Referral';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="content-items">
        <div class="note-box rounded" style=''>
            <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
            <h3>Referral System</h3>
            <div id="content-button">
                <a data-toggle="tooltip" title="Back" href='/' class="btn btn-primary button-left-corner"><i class="fa fa-arrow-circle-left"></i></a>
                <a data-toggle="tooltip" title="Proceed" href='http://referral.onelab.ph' class="btn btn-primary button-right-corner"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <hr class="hr-line">
            <div class="onelab-content">
                <p style="text-align: justify">
                    The <strong>Referral System </strong> is a ULIMS extended application that will handle referral of Sample 
                    to another testing Laboratories. Customer can manage his/her Sample Test and check the status of their request. This System 
                    can be accessed publicly as this is hosted in public hosting.
                </p>
                <p style="text-align: justify">
                <h3>The Following are the functions that the Referral System provide</h3>
                <ol class="content-font">
                    <li>Customer can manage his/her request.</li>
                    <li>Customer can create request</li>
                    <li>Tracking of Request</li>
                    <li>Can View/Request Test Calibration Services</li>
                    <li>Can Manage his/her account profile</li>
                </ol>
                <img src="/images/tracking.png" width="800" alt=""/>
                </p>
                <img src="/images/referral.png" alt="" width="700" height="380"/>
            </div>
            <div style="height: 30px"></div>
        </div>
    </div>  
</div>
