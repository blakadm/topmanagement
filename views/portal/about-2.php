<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="content-items">
        <div class="note-box rounded" style=''>
            <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
            <h3>About OneLab</h3>
            <div id="content-button">
                <a data-toggle="tooltip" title="Back" href='/' class="btn btn-primary button-left-corner"><i class="fa fa-arrow-circle-left"></i></a>
                <a data-toggle="tooltip" title="Proceed" href='/' class="btn btn-primary button-right-corner"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <hr class="hr-line">
            <div class="onelab-content">
                <p style="text-align: justify">
                    A <strong>Network of laboratories</strong> anchored on an <strong>IT Platform</strong> which broadens public access to testing and calibration 
                    services at single touch point.
                </p>
                <p style="text-align: justify">
                    The <strong>OneLab</strong> project is <strong>DOST’s</strong> platform that comprehensively provides an avenue for customers to meet their testing needs at a single touch point. 
                </p>
                <p style="text-align: justify">
                    OneLab envisions to broaden public access to testing services of all DOST laboratories, provide standardized services and fees and to provide timely and accurate test and calibration results.  The customers are spared from shuttling from one laboratory to another.  
                </p>
                <p style="text-align: justify">
                    These are made possible through the in-house developed <strong>Unified Laboratory Information Management System (ULIMS)</strong>. The ULIMS has six (6) operating components  to wit:
                </p>
                <ol class="content-font">
                    <li><b>Data Management</b></li>
                    <li><b>Sample Management</b></li>
                    <li><b>Resource Management</b></li>
                    <li><b>Real Time Inventory</b></li>
                    <li><b>Customer Portal</b></li>
                    <li><b>Web Services </b></li>
                </ol>
                <img src="/images/ulims.png" alt="" width="600" height="280"/>
            </div>
        </div>
    </div>  
</div>
