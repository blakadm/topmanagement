<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
?>

                                     <?=
                                    GridView::widget([
                                        'dataProvider' => $dataSampleTests,
                                        'summary' => "",
                                        'id'=>'gridSampleTests',
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                       //     'year',
                                            'name',
                                            'topcount',
                                        ],
                                    ]);
                                    ?>
