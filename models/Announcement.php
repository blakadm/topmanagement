<?php

namespace app\models;

use Yii;
use \app\models\base\Announcement as BaseAnnouncement;

/**
 * This is the model class for table "tbl_announcement".
 */
class Announcement extends BaseAnnouncement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['AnnouncementTypeID', 'Title', 'Announcement', 'StartDate', 'EndDate'], 'required'],
            [['AnnouncementTypeID'], 'integer'],
            [['Announcement'], 'string'],
            [['StartDate', 'EndDate'], 'safe'],
            [['Title'], 'string', 'max' => 100],
            [['StartDate', 'EndDate'], 'unique', 'targetAttribute' => ['StartDate', 'EndDate'], 'message' => 'The combination of Start Date and End Date has already been taken.'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
