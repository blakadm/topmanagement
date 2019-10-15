<?php

/* 
 * Project Name: onelab.gov.ph-Top_Management * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 05 3, 18 , 10:57:27 AM * 
 * Module: chart * 
 */
?>
<?php
$Categories = ['categories' => ['DOST-I', 'DOST-II', 'DOST-III', 'DOST-IV', 'DOST-V', 'DOST-VI', 'DOST-VII', 'DOST-VIII', 'DOST-IX']];
$Series = [
    [
        'name' => 'RSTL',
        'colorByPoint' => true,
        'type' => 'pie',
        'data' => [
            ['name' => 'DOST-I', 'y' => 61.14, 'sliced' => true, 'selected' => true],
            ['name' => 'DOST-II', 'y' => 230],
            ['name' => 'DOST-III', 'y' => 130],
            ['name' => 'DOST-IV', 'y' => 80],
            ['name' => 'DOST-V', 'y' => 330],
            ['name' => 'DOST-VI', 'y' => 630],
            ['name' => 'DOST-VII', 'y' => 1230],
            ['name' => 'DOST-VIII', 'y' => 210],
            ['name' => 'DOST-IX', 'y' => 2230]
        ]
    ],
];
Yii::$app->PostedData->GenerateChart("TestChart","pie", "# of Customers", "Customers", "/toplevel/statistics/customers", $Categories, $Series, 700, 500);
?>
