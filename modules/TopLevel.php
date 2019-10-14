<?php

namespace app\modules;
use Yii;
/**
 * toplevel module definition class
 */
class TopLevel extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
