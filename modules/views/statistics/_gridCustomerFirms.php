<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
?>

                                     <?=
                                    GridView::widget([
                                        'dataProvider' => $dataCustomerFirms,
                                        'summary' => "",
                                        'id'=>'gridCustomerFirms',
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                       //     'year',
                                            'name',
                                            'topcount',
                                        ],
                                    ]);
                                    ?>
