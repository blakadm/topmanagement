<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Topics:';
$this->params['breadcrumbs'][] = $this->title;
$js='
$(document).ready(function(){/* jQuery toggle layout */
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});   
';
$this->registerJs($js);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book"></i> Search Topics</div>
        <div class="panel-body">
            <div class="col-md-8">
                <div class="input-group col-md-6">
                    <input type="text" name="SearchTopic" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                    </span>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <hr>
            <div class="row" style="padding-top: 10px;padding-left: 10px">
    <div class="col-md-8">
        <table class="table table-condensed table-responsive table-striped table-hover table-bordered table-pointer">
            <thead class="btn-primary">
                <tr>
                    <th style="width: 20px;text-align: center">#</th>
                    <th style="width: 350px">Category</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                if($model){
                foreach ($model as $doc){ ?>
                    <tr class='clickable-row' data-href='/help/show?id=<?= $doc->DocumentationID ?>'>
                        <td><?= $i ?></td>
                        <td><?= $doc->category->Category ?></td>
                        <td><?= $doc->Title ?></td>
                    </tr> 
                <?php 
                    $i++; 
                    }
                }else{ ?>
                    <tr class='clickable-row' data-href='#'>
                        <td colspan="3" style="text-align: center">No Topic Found</td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
        </div>
    </div>
</div>
