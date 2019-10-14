<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_analysis".
 *
 * @property integer $AnalysisID
 * @property integer $OrigAnalysisID
 * @property integer $RSTLID
 * @property integer $PSTCAnalysis_id
 * @property string $RequestID
 * @property integer $SampleID
 * @property string $SampleCode
 * @property string $TestName
 * @property string $Method
 * @property string $References
 * @property integer $Quantity
 * @property double $Fee
 * @property integer $TestId
 * @property integer $AnalysisMonth
 * @property integer $AnalysisYear
 * @property integer $Package
 * @property integer $Cancelled
 * @property integer $Deleted
 * @property integer $TaggingId
 * @property integer $user_id
 *
 * @property Samples $sample
 */
class Analysis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_analysis';
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
            [['OrigAnalysisID', 'RSTLID', 'PSTCAnalysis_id', 'SampleID', 'SampleCode', 'TestName', 'Method', 'References', 'Quantity', 'TestId', 'AnalysisMonth', 'AnalysisYear', 'Package', 'Cancelled', 'Deleted'], 'required'],
            [['OrigAnalysisID', 'RSTLID', 'PSTCAnalysis_id', 'SampleID', 'Quantity', 'TestId', 'AnalysisMonth', 'AnalysisYear', 'Package', 'Cancelled', 'Deleted', 'TaggingId', 'user_id'], 'integer'],
            [['Fee'], 'number'],
            [['RequestID'], 'string', 'max' => 50],
            [['SampleCode'], 'string', 'max' => 20],
            [['TestName'], 'string', 'max' => 200],
            [['Method'], 'string', 'max' => 150],
            [['References'], 'string', 'max' => 100],
            [['SampleID'], 'exist', 'skipOnError' => true, 'targetClass' => Samples::className(), 'targetAttribute' => ['SampleID' => 'SampleID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AnalysisID' => 'Analysis ID',
            'OrigAnalysisID' => 'Orig Analysis ID',
            'RSTLID' => 'Rstlid',
            'PSTCAnalysis_id' => 'Pstcanalysis ID',
            'RequestID' => 'Request ID',
            'SampleID' => 'Sample ID',
            'SampleCode' => 'Sample Code',
            'TestName' => 'Test Name',
            'Method' => 'Method',
            'References' => 'References',
            'Quantity' => 'Quantity',
            'Fee' => 'Fee',
            'TestId' => 'Test ID',
            'AnalysisMonth' => 'Analysis Month',
            'AnalysisYear' => 'Analysis Year',
            'Package' => 'Package',
            'Cancelled' => 'Cancelled',
            'Deleted' => 'Deleted',
            'TaggingId' => 'Tagging ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSample()
    {
        return $this->hasOne(Samples::className(), ['SampleID' => 'SampleID']);
    }
}
