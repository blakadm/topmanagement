<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_membertype".
 *
 * @property integer $MemberTypeID
 * @property string $MemberType
 *
 * @property Agency[] $agencies
 */
class Membertype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_membertype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MemberType'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MemberTypeID' => 'Member Type ID',
            'MemberType' => 'Member Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencies()
    {
        return $this->hasMany(Agency::className(), ['membertypeid' => 'MemberTypeID']);
    }
}
