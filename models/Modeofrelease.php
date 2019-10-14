<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_modeofrelease".
 *
 * @property integer $ModeOfReleaseID
 * @property string $Mode
 * @property integer $Status
 *
 * @property Request[] $Requests
 */
class Modeofrelease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_modeofrelease';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('topdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ModeOfReleaseID', 'Mode', 'Status'], 'required'],
            [['ModeOfReleaseID', 'Status'], 'integer'],
            [['Mode'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ModeOfReleaseID' => 'Mode Of Release ID',
            'Mode' => 'Mode',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['ModeOfReleaseID' => 'ModeOfReleaseID']);
    }
}
