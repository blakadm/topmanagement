<?php

return [
    'db'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=onelab.ph',
    //    'username' => 'root',
      //  'password' => 'Arkem@88',
   //   'username' => 'root',
    //  'password' => 'Arkem@88',
	  
        'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ],
    'labdb'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=eulims_lab',
      //  'username' => 'eulims',
      //  'password' => 'eulims',
        'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ],
    'dbapi'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=eulims',
      //  'username' => 'root',
      //  'password' => 'Arkem@88',
        'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ],
    'topdb'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=toplevel',
      //  'username' => 'root',
      //  'password' => 'Arkem@88',
       'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ],
    'referraldb'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=referral.onelab.ph',
       // 'username' => 'root',
       // 'password' => 'Arkem@88',
        'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ],
     'inventorydb'=>[
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=toplevel_inventory',
     //   'username' => 'root',
     //   'password' => 'Arkem@88',
        'username'=>'arisro9',
        'password'=>'qwerty!@#$%',
        'charset' => 'utf8',
        'tablePrefix' => 'tbl_',
    ]
];
