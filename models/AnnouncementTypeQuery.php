<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AnnouncementType]].
 *
 * @see AnnouncementType
 */
class AnnouncementTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AnnouncementType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AnnouncementType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
