<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_request".
 *
 * @property integer $RequestID
 * @property integer $OrigRequestID
 * @property integer $RSTLID
 * @property integer $LabID
 * @property string $RequestRefNumber
 * @property string $RequestDateTime
 * @property string $CustomerCode
 * @property integer $PaymentTypeID
 * @property integer $ModeOfReleaseID
 * @property integer $DiscountID
 * @property integer $PurposeID
 * @property double $Total
 * @property integer $Cancelled
 * @property integer $Completed
 * @property string $CreateTime
 *
 * @property Purpose $purpose
 * @property Discount $discount
 * @property Lab $lab
 * @property Paymenttype $paymentType
 * @property Modeofrelease $modeOfRelease
 * @property Samples[] $samples
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request';
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
            [['OrigRequestID', 'RSTLID', 'LabID', 'PaymentTypeID', 'ModeOfReleaseID', 'DiscountID', 'PurposeID', 'Cancelled', 'Completed'], 'integer'],
            [['RSTLID', 'LabID', 'RequestRefNumber', 'RequestDateTime', 'CustomerCode', 'PaymentTypeID', 'ModeOfReleaseID', 'PurposeID', 'CreateTime'], 'required'],
            [['RequestDateTime', 'CreateTime'], 'safe'],
            [['Total'], 'number'],
            [['RequestRefNumber'], 'string', 'max' => 50],
            [['CustomerCode'], 'string', 'max' => 11],
            [['RequestRefNumber'], 'unique'],
            [['OrigRequestID', 'RSTLID'], 'unique', 'targetAttribute' => ['OrigRequestID', 'RSTLID'], 'message' => 'The combination of Orig Request ID and Rstlid has already been taken.'],
            [['PurposeID'], 'exist', 'skipOnError' => true, 'targetClass' => Purpose::className(), 'targetAttribute' => ['PurposeID' => 'PurposeID']],
            [['DiscountID'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountID' => 'DiscountID']],
            [['LabID'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['LabID' => 'LabID']],
            [['PaymentTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttype::className(), 'targetAttribute' => ['PaymentTypeID' => 'PaymentTypeID']],
            [['ModeOfReleaseID'], 'exist', 'skipOnError' => true, 'targetClass' => Modeofrelease::className(), 'targetAttribute' => ['ModeOfReleaseID' => 'ModeOfReleaseID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RequestID' => 'Request ID',
            'OrigRequestID' => 'Orig Request ID',
            'RSTLID' => 'Rstlid',
            'LabID' => 'Lab ID',
            'RequestRefNumber' => 'Request Ref Number',
            'RequestDateTime' => 'Request Date Time',
            'CustomerCode' => 'Customer Code',
            'PaymentTypeID' => 'Payment Type ID',
            'ModeOfReleaseID' => 'Mode Of Release ID',
            'DiscountID' => 'Discount ID',
            'PurposeID' => 'Purpose ID',
            'Total' => 'Total',
            'Cancelled' => 'Cancelled',
            'Completed' => 'Completed',
            'CreateTime' => 'Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurpose()
    {
        return $this->hasOne(Purpose::className(), ['PurposeID' => 'PurposeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['DiscountID' => 'DiscountID']);
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
    public function getPaymentType()
    {
        return $this->hasOne(Paymenttype::className(), ['PaymentTypeID' => 'PaymentTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeOfRelease()
    {
        return $this->hasOne(Modeofrelease::className(), ['ModeOfReleaseID' => 'ModeOfReleaseID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Samples::className(), ['RequestID' => 'RequestID']);
    }
}
