<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_article_attachments".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $title
 * @property string $alias
 * @property string $titleAttribute
 * @property string $filename
 * @property string $extension
 * @property string $mimetype
 * @property integer $size
 * @property integer $hits
 *
 * @property ArticleItems $item
 */
class ArticleAttachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_article_attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'title', 'filename', 'extension', 'mimetype', 'size'], 'required'],
            [['item_id', 'size', 'hits'], 'integer'],
            [['titleAttribute'], 'string'],
            [['title', 'alias', 'filename', 'mimetype'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 12],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleItems::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'titleAttribute' => 'Title Attribute',
            'filename' => 'Filename',
            'extension' => 'Extension',
            'mimetype' => 'Mimetype',
            'size' => 'Size',
            'hits' => 'Hits',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(ArticleItems::className(), ['id' => 'item_id']);
    }
}
