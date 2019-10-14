<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_agency".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property string $website
 * @property string $contact
 * @property string $address
 * @property string $geo_location
 * @property integer $activated
 * @property integer $ordernumber
 * @property integer $membertypeid
 *
 * @property Profile[] $profiles
 * @property Request[] $request
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agency';
    }
    
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'code', 'description', 'website', 'contact', 'address', 'geo_location', 'activated', 'ordernumber'], 'required'],
            [['region_id', 'activated', 'ordernumber','membertypeid'], 'integer'],
            [['description', 'contact', 'address'], 'string'],
            [['name', 'website', 'geo_location'], 'string', 'max' => 256],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'code' => 'Code',
            'description' => 'Description',
            'website' => 'Website',
            'contact' => 'Contact',
            'address' => 'Address',
            'geo_location' => 'Geo Location',
            'activated' => 'Activated',
            'ordernumber' => 'Ordernumber',
            'membertypeid'=>'MemberTypeId'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['AgencyID' => 'id']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasMany(Request::className(), ['RSTLID' => 'id']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembertype()
    {
        return $this->hasOne(Membertype::className(), ['membertypeid' => 'MemberTypeID']);
    }
}
