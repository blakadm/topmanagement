<?php

namespace app\models;

use \app\models\base\AnnouncementType as BaseAnnouncementType;

/**
 * This is the model class for table "tbl_announcementtype".
 */
class AnnouncementType extends BaseAnnouncementType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['AnnouncementType'], 'string', 'max' => 30],
            [['CSSClass'], 'string', 'max' => 50],
            [['AnnouncementType'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
