<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_highchart_themes".
 *
 * @property integer $highchart_theme_id
 * @property string $theme
 */
class HighchartThemes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_highchart_themes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'highchart_theme_id' => 'Highchart Theme ID',
            'theme' => 'Theme',
        ];
    }
}
