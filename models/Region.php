<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_region".
 *
 * @property integer $region_id
 * @property string $psgc_code
 * @property string $region
 * @property string $reg_desc
 * @property string $short_desc
 * @property string $reg_code
 * @property integer $orderby
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_desc'], 'string'],
            [['orderby'], 'required'],
            [['orderby'], 'integer'],
            [['psgc_code', 'reg_code'], 'string', 'max' => 255],
            [['region', 'short_desc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'psgc_code' => 'Psgc Code',
            'region' => 'Region',
            'reg_desc' => 'Reg Desc',
            'short_desc' => 'Short Desc',
            'reg_code' => 'Reg Code',
            'orderby' => 'Orderby',
        ];
    }
}
