<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_equipment".
 *
 * @property integer $EquipmentID
 * @property integer $RSTLID
 * @property integer $OrigEquipmentID
 * @property string $EquipmentCode
 * @property string $EquipmentName
 * @property integer $LabID
 * @property integer $ClassificationID
 * @property string $Model
 * @property string $SerialNum
 * @property double $Amount
 * @property integer $EquipmentStatusID
 * @property integer $FundingID
 *
 * @property Lab $lab
 * @property Fundings $funding
 * @property Equipmentstatus $equipmentStatus
 * @property Classification $classification
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_equipment';
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
            [['RSTLID', 'OrigEquipmentID', 'EquipmentCode', 'EquipmentName', 'LabID', 'ClassificationID', 'FundingID'], 'required'],
            [['RSTLID', 'OrigEquipmentID', 'LabID', 'ClassificationID', 'EquipmentStatusID', 'FundingID'], 'integer'],
            [['Amount'], 'number'],
            [['EquipmentCode'], 'string', 'max' => 50],
            [['EquipmentName'], 'string', 'max' => 100],
            [['Model'], 'string', 'max' => 150],
            [['SerialNum'], 'string', 'max' => 200],
            [['RSTLID', 'OrigEquipmentID'], 'unique', 'targetAttribute' => ['RSTLID', 'OrigEquipmentID'], 'message' => 'The combination of Rstlid and Orig Equipment ID has already been taken.'],
            [['LabID'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['LabID' => 'LabID']],
            [['FundingID'], 'exist', 'skipOnError' => true, 'targetClass' => Fundings::className(), 'targetAttribute' => ['FundingID' => 'FundingID']],
            [['EquipmentStatusID'], 'exist', 'skipOnError' => true, 'targetClass' => Equipmentstatus::className(), 'targetAttribute' => ['EquipmentStatusID' => 'EquipmentStatusID']],
            [['ClassificationID'], 'exist', 'skipOnError' => true, 'targetClass' => Classification::className(), 'targetAttribute' => ['ClassificationID' => 'ClassificationID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EquipmentID' => 'Equipment ID',
            'RSTLID' => 'Rstlid',
            'OrigEquipmentID' => 'Orig Equipment ID',
            'EquipmentCode' => 'Equipment Code',
            'EquipmentName' => 'Equipment Name',
            'LabID' => 'Lab ID',
            'ClassificationID' => 'Classification ID',
            'Model' => 'Model',
            'SerialNum' => 'Serial Num',
            'Amount' => 'Amount',
            'EquipmentStatusID' => 'Equipment Status ID',
            'FundingID' => 'Funding ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['LabID' => 'LabID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunding()
    {
        return $this->hasOne(Fundings::className(), ['FundingID' => 'FundingID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentStatus()
    {
        return $this->hasOne(Equipmentstatus::className(), ['EquipmentStatusID' => 'EquipmentStatusID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassification()
    {
        return $this->hasOne(Classification::className(), ['ClassificationID' => 'ClassificationID']);
    }
}
