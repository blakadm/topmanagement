<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="content-items">
        <div class="note-box rounded" style=''>
            <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
            <h3>Services</h3>
            <div id="content-button">
                <a data-toggle="tooltip" title="Back" href='/' class="btn btn-primary button-left-corner"><i class="fa fa-arrow-circle-left"></i></a>
                <a data-toggle="tooltip" title="Services" href='https://customer.onelab.ph/#/services' class="btn btn-primary button-right-corner"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <hr class="hr-line">
            <div class="onelab-content">
                <p style="text-align: justify;font-size: 18px">
                    The <strong>OneLab Services </strong> provides tool to users to perform search on availability of services across 
                    the nation serving at least 17 regional testing laboratories.
                </p>
                <p style="text-align: justify">
                <h3 class="breadcrumb">Users can perform search services for the following:</h3>
                <ol class="list-group col-sm-4">
                    <li class="list-group-item"><strong>Sample Test.</strong></li>
                    <li class="list-group-item"><strong>RSTL that offers such Test:</strong></li>
                    <ul class="list-group col-md-8" style="margin-left: 15px">
                        <li class="list-group-item">Microbiology Laboratory</li>
                        <li class="list-group-item">Chemical Laboratory</li>
                        <li class="list-group-item">Metrology Laboratory</li>
                        <li class="list-group-item">Physical Laboratory</li>
                        <li class="list-group-item">Formula of Manufacture</li>
                        <li class="list-group-item">Shelf Life Testing</li>
                        <li class="list-group-item">Proficiency Testing Program</li>
                        <li class="list-group-item">Reference Material Provision</li>
                    </ul>
                </ol>
                </p>
                <img src="/images/services.png" alt="" width="600" height="280"/>
            </div>
            <div style="height: 30px"></div>
        </div>
    </div>  
</div>
