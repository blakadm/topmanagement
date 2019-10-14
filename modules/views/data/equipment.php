<?php
/* @var $this yii\web\View */
use yii\web\View;

$js="
$('#onelabportal').removeClass('active');
$('#toplevel').addClass('active');
";
$this->registerJs($js, View::POS_END);
$this->title="Equipment";
$this->params['breadcrumbs'][] = ['label' => 'Top Level', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Equipment</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>