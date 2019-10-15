<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
if($name=='Forbidden (#403)'){
    $imgUrl="/images/forbidden.jpg";
}elseif($name=='Not Found (#404)'){
    $imgUrl="/images/notfound.jpg";
}else{
    $imgUrl="/images/somethingwentwrong.png"; 
}
?>
<div class="site-error">
    <div class="row">
        <div class="col-xs-12">
            <img src="<?= $imgUrl ?>" class="img-responsive" alt="Responsive image"/>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;padding-left: 15px;padding-right: 15px">
        <div class="col-xs-12 alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;padding-left: 15px;padding-right: 15px">
            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>
    </div>
</div>
