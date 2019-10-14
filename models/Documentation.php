<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_documentation".
 *
 * @property integer $DocumentationID
 * @property string $Title
 * @property string $DocumentContent
 * @property integer $CategoryID
 *
 * @property Category $category
 */
class Documentation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_documentation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Title', 'DocumentContent', 'CategoryID'], 'required'],
            [['DocumentContent'], 'string'],
            [['CategoryID'], 'integer'],
            [['Title'], 'string', 'max' => 100],
            [['CategoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryID' => 'CategoryID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DocumentationID' => 'Documentation ID',
            'Title' => 'Title',
            'DocumentContent' => 'Content',
            'CategoryID' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['CategoryID' => 'CategoryID']);
    }
}
