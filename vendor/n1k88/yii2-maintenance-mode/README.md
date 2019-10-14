Yii2-maintenance
================

Installation
------------

Add to the require section of your `composer.json` file:
```
"n1k88/yii2-maintenance-mode": "*"
```

Add to your config file:
```php
   'bootstrap' => ['log', 'maintenance'],
   ...
   'modules' => [
     'maintenance' => [
        'class' => 'n1k88\maintenance\Module',
        // optional
        'maintenanceFileOn' => 'maintenance.on', // default is `maintenance.on`
     ],
   ],
```

Create a file in the `@web` directory named `maintenance.on` to activate the maintenance mode.