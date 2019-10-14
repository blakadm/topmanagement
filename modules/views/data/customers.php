<?php
use yii\web\View;
/* @var $this yii\web\View */
$js="
$('#onelabportal').removeClass('active');
$('#toplevel').addClass('active');
";
$this->registerJs($js, View::POS_END);
$this->title="Customers";
$this->params['breadcrumbs'][] = ['label' => 'Top Level', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Customers</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>