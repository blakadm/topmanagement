<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_samples".
 *
 * @property integer $SampleID
 * @property integer $OrigSampleID
 * @property integer $RSTLID
 * @property integer $RequestID
 * @property integer $SampleTypeID
 * @property string $SampleName
 * @property string $Description
 * @property integer $SampleMonth
 * @property integer $SampleYear
 * @property integer $Cancelled
 * @property integer $Completed
 *
 * @property Analysis[] $tblAnalyses
 * @property Request $request
 * @property Sampletype $sampleType
 */
class Samples extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_samples';
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
            [['OrigSampleID', 'RSTLID', 'RequestID', 'SampleTypeID', 'SampleName', 'SampleMonth', 'SampleYear'], 'required'],
            [['OrigSampleID', 'RSTLID', 'RequestID', 'SampleTypeID', 'SampleMonth', 'SampleYear', 'Cancelled', 'Completed'], 'integer'],
            [['Description'], 'string'],
            [['SampleName'], 'string', 'max' => 50],
            [['RequestID'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['RequestID' => 'RequestID']],
            [['SampleTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => Sampletype::className(), 'targetAttribute' => ['SampleTypeID' => 'SampleTypeID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SampleID' => 'Sample ID',
            'OrigSampleID' => 'Orig Sample ID',
            'RSTLID' => 'Rstlid',
            'RequestID' => 'Request ID',
            'SampleTypeID' => 'Sample Type ID',
            'SampleName' => 'Sample Name',
            'Description' => 'Description',
            'SampleMonth' => 'Sample Month',
            'SampleYear' => 'Sample Year',
            'Cancelled' => 'Cancelled',
            'Completed' => 'Completed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalyses()
    {
        return $this->hasMany(Analysis::className(), ['SampleID' => 'SampleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['RequestID' => 'RequestID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampleType()
    {
        return $this->hasOne(Sampletype::className(), ['SampleTypeID' => 'SampleTypeID']);
    }
}
