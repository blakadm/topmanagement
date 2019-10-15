<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'ePayment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="content-items">
        <div class="note-box rounded" style=''>
            <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
            <h3>ePayment</h3>
            <div id="content-button">
                <a data-toggle="tooltip" title="Back" href='/' class="btn btn-primary button-left-corner"><i class="fa fa-arrow-circle-left"></i></a>
                <a data-toggle="tooltip" title="ePayment Portal" href='https://payment.onelab.ph' class="btn btn-primary button-right-corner"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <hr class="hr-line">
            <div class="onelab-content">
                <p style="text-align: justify">
                    The <strong>ePayment</strong> is DOST's Payment Portal that will handle online payment for ULIMS sample testing fee.
                </p>
                <h3>ePayment System that can handle payment using the following payment method:</h3>
                <ol class="content-font">
                    <li><p><b><i>Debit card</i></b> a Payroll ATM card that supports VISA, Master Card 
                        </p>
                    </li>
                    <li>
                        <p>
                            <b><i>Credit Card</i></b> like VISA, Master Card, JCB.
                        </p>
                    </li>
                    <li>
                        <b><i>PayPal</i></b> an online payment method that requires you a PayPal account.
                    </li>
                </ol>
                <p style="text-align: justify">
                    Customer can manage his payment histories by logging in using the provided login credentials, they can also 
                    check the status of payment per each transactions or print a temporary receipt anytime in case they were not able
                    to print during payment transactions.
                </p>
                <img src="/images/payment.png" alt="" width="600" height="280"/>
            </div>
            <div style="height: 30px"></div>
        </div>
    </div>  
</div>
