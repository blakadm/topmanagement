<?php

/* 
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2017 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 12 16, 17 , 7:42:15 PM * 
 * Module: _routes * 
 */
return [
    'admin/role/view/<id:>' => 'admin/role/view', //admin/role/view?id=admin
    'admin/role/update/<id:>' => 'admin/role/update', //admin/role/view?id=admin
    'admin/permission/view/<id:>' => 'admin/permission/view',
    'admin/user/view/<id:>' => 'admin/user/view',
    'admin/user/update/<id:>' => 'admin/user/update',
    'admin/assignment/view/<id:>' => 'admin/assignment/view',
    'admin/user/login' => 'admin/user/login',
    'articles/items/view/<id:>' => 'articles/items/view', //admin/role/view?id=admin
    'articles/items/update/<id:>/<alias:>/<cat:>' => 'articles/items/update', 
    'articles/items/update/<id:>' => 'articles/items/update',
    'articles/'=>'articles/items',
    //'<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/categories/view',
    //'<cat>/<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/items/view',
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];
