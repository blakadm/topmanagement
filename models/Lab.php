<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_lab".
 *
 * @property integer $LabID
 * @property string $LabName
 * @property string $LabCode
 * @property integer $LabCount
 * @property string $NextRequestCode
 * @property integer $Status
 *
 * @property Equipment[] $Equipments
 * @property Request[] $Requests
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lab';
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
            [['LabName', 'LabCode', 'LabCount', 'NextRequestCode', 'Status'], 'required'],
            [['LabCount', 'Status'], 'integer'],
            [['LabName', 'NextRequestCode'], 'string', 'max' => 50],
            [['LabCode'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LabID' => 'Lab ID',
            'LabName' => 'Lab Name',
            'LabCode' => 'Lab Code',
            'LabCount' => 'Lab Count',
            'NextRequestCode' => 'Next Request Code',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['LabID' => 'LabID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRequests()
    {
        return $this->hasMany(Request::className(), ['LabID' => 'LabID']);
    }
}
