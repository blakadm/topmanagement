<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_sampletype".
 *
 * @property integer $SampleTypeID
 * @property string $SampleType
 * @property integer $TestCategoryId
 *
 * @property Samples[] $samples
 */
class Sampletype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sampletype';
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
            [['SampleType', 'TestCategoryId'], 'required'],
            [['TestCategoryId'], 'integer'],
            [['SampleType'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SampleTypeID' => 'Sample Type ID',
            'SampleType' => 'Sample Type',
            'TestCategoryId' => 'Test Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Samples::className(), ['SampleTypeID' => 'SampleTypeID']);
    }
}
