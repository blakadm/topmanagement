<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
?>

                                     <?=
                                    GridView::widget([
                                        'dataProvider' => $dataIncomeTrans,
                                        'summary' => "",
                                        'id'=>'gridIncomeTrans',
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                       //     'year',
                                            'name',
                                            'topcount',
                                        ],
                                    ]);
                                    ?>
                                    

