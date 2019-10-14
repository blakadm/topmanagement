<?php
namespace app\components;

use Yii;
use yii\base\Component;
use dosamigos\highcharts\HighCharts;

/**
 * Description of Nolan
 *
 * @author Programmer
 */
class GetData extends Component {
    function CreateSpace($SpaceCount){
        $Ret="";
        for($i=1;$i<=$SpaceCount;$i++){
            $Ret.="&nbsp;";
        }
        return $Ret;
    }
    function GetPostedData(){
        //$formatter = \Yii::$app->formatter;
        $formatter = Yii::$app->formatter;
        $Proc="CALL spRSTLPosting()";
        $connection=Yii::$app->db;
        $command=$connection->createCommand($Proc);
        $PostedArr=$command->queryAll();
        $PostedData='<table class="table table-responsive table-bordered table-hover" style="fonst-size: 11px">';
        $PostedData.='<thead>';
        $PostedData.='<th>Agency</th>';
        $PostedData.='<th>Status</th>';
        $PostedData.='<th>Posted</th>';
        $PostedData.='</thead>';
        foreach($PostedArr as $Posted){
            if($Posted['PostedDateTime']==NULL){
                $LabelData='<small class = "label label-danger"><i class = "fa fa-clock-o"></i> Unposted</small>';
                $LabelTools="-";
            }else{
                $LabelData='<small class = "label label-success"><i class = "fa fa-clock-o"></i> Posted</small>';
                //$LabelTools=$formatter->asDate($Posted['PostedDateTime'], 'php:m/d/Y H:i:s');
                $sDate=date_create($Posted['PostedDateTime']);
                $LabelTools=date_format($sDate,"m/d/Y H:i A"); 
            }
            $PostedData.='<tr>';
            $PostedData.='<td>'.$Posted['Agency'].'</td>';
            $PostedData.='<td>'.$LabelData.'</td>';
            $PostedData.='<td>'.$LabelTools.'</td>';
            $PostedData.='</tr>';
        }
        $PostedData.='</table>';
        return $PostedData;
    }
    /**
     * 
     * @param String $ChartType
     * @param String $YAxisTitle
     * @param String $Title
     * @param String $TitleLink
     * @param array $Categories
     * @param array $Series
     */
    function GenerateChart($ChartID,$ChartType,$YAxisTitle,$Title,$TitleLink,array &$Categories, array &$Series,$Width=365, $Height=230,$Theme="sand-signika",$Dec="2.f") {
        //echo "<div class='row'><img src='/images/ajax-loader.gif'></div>";
        $Chart= HighCharts::widget([
            'id'=>$ChartID,
            'clientOptions' => [
                'chart' => [
                    'id'=>'MyChart',
                    'type' =>$ChartType,
                    'zoomType'=> 'x',
                    'panning'=> true,
                    'panKey'=> 'shift',
                    'height'=>$Height,
                ],
                'title' => ['text' => '<a href="'.$TitleLink.'">'.$Title.'</a>'],
                'xAxis' => $Categories,
                'yAxis' => [
                    'title' => [
                        'text' => $YAxisTitle
                    ],
                ],
                'credits'=>false,
                'theme'=> $Theme, //sand-signika
                'plotOptions'=> [
                    'line'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "{point.y:#,000.$Dec}", 
                            'y'=> 0, // 10 pixels down from the top
                        ],
                        'enableMouseTracking'=> true
                    ],
                    'spline'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "{point.y:#,000.$Dec}", 
                            'y'=> 0, // 10 pixels down from the top
                        ],
                        'enableMouseTracking'=> true
                    ],
                    'bar'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "{point.y:#,000.$Dec}", 
                            'y'=> 0, // 10 pixels down from the top
                        ],
                        'enableMouseTracking'=> true
                    ],
                    'column'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "{point.y:#,000.$Dec}", 
                            'y'=> 0, // 10 pixels down from the top
                        ],
                        'enableMouseTracking'=> true
                    ],
                    'area'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "{point.y:#,000.$Dec}", 
                            'y'=> 0, // 10 pixels down from the top
                        ],
                        'enableMouseTracking'=> true
                    ],
                    'pie'=> [
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> "<b>{point.name}</b>: {point.percentage:.$Dec} %",
                            'allowPointSelect'=> true,
                            //'style'=> [
                                //   'color'=>'black'
                            //]
                        ],
                        'enableMouseTracking'=> true,
                        'showInLegend'=> true
                    ]
                ],
                /*[
                    'enabled'=> false
                ],*/
                'series' => $Series,
                'exporting'=> [
                    'menuItemDefinitions'=> [
                        'label'=>[
                            'onclick'=>new \yii\web\JsExpression("function(){
                               InitiateIteration();}
                            "),
                            'text'=> 'Hide/Show All'
                        ],
                        'export_excel'=>[
                            'onclick'=>new \yii\web\JsExpression("function(){
                               ExportToExcel();}
                            "),
                            'text'=> 'Export to Excel'
                        ],
                        'export_pdf'=>[
                            'onclick'=>new \yii\web\JsExpression("function(){
                               ExportToPDF();}
                            "),
                            'text'=> 'Export to PDF'
                        ]
                    ],
                    'buttons'=>[
                        'contextButton'=>[
                            'menuItems'=> ['printChart','downloadPNG','downloadJPEG','downloadPDF', 'separator', 'label','export_excel','export_pdf']
                        ]
                    ]
                ]
            ]
        ]);
        echo $Chart;
    }
}
