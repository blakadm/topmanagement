<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_article_items".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property string $title
 * @property string $alias
 * @property string $introtext
 * @property string $fulltext
 * @property integer $state
 * @property string $access
 * @property string $language
 * @property string $theme
 * @property integer $ordering
 * @property integer $hits
 * @property string $image
 * @property string $image_caption
 * @property string $image_credits
 * @property string $video
 * @property string $video_type
 * @property string $video_caption
 * @property string $video_credits
 * @property string $params
 * @property string $metadesc
 * @property string $metakey
 * @property string $robots
 * @property string $author
 * @property string $copyright
 * @property integer $user_id
 * @property integer $created_by
 * @property string $created
 * @property integer $modified_by
 * @property string $modified
 *
 * @property ArticleAttachments[] $articleAttachments
 * @property ArticleCategories $cat
 * @property User $createdBy
 * @property User $modifiedBy
 * @property User $user
 * @property ArticleTagsAssign[] $articleTagsAssigns
 */
class ArticleItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_article_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'ordering', 'hits', 'user_id', 'created_by', 'modified_by'], 'integer'],
            [['title', 'access', 'language'], 'required'],
            [['introtext', 'fulltext', 'image', 'video', 'params', 'metadesc', 'metakey'], 'string'],
            [['created', 'modified'], 'safe'],
            [['title', 'alias', 'image_caption', 'image_credits', 'video_caption', 'video_credits'], 'string', 'max' => 255],
            [['state'], 'string', 'max' => 1],
            [['access'], 'string', 'max' => 64],
            [['language'], 'string', 'max' => 7],
            [['theme'], 'string', 'max' => 12],
            [['video_type', 'robots'], 'string', 'max' => 20],
            [['author', 'copyright'], 'string', 'max' => 50],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategories::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'introtext' => 'Introtext',
            'fulltext' => 'Fulltext',
            'state' => 'State',
            'access' => 'Access',
            'language' => 'Language',
            'theme' => 'Theme',
            'ordering' => 'Ordering',
            'hits' => 'Hits',
            'image' => 'Image',
            'image_caption' => 'Image Caption',
            'image_credits' => 'Image Credits',
            'video' => 'Video',
            'video_type' => 'Video Type',
            'video_caption' => 'Video Caption',
            'video_credits' => 'Video Credits',
            'params' => 'Params',
            'metadesc' => 'Metadesc',
            'metakey' => 'Metakey',
            'robots' => 'Robots',
            'author' => 'Author',
            'copyright' => 'Copyright',
            'user_id' => 'User ID',
            'created_by' => 'Created By',
            'created' => 'Created',
            'modified_by' => 'Modified By',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAttachments()
    {
        return $this->hasMany(ArticleAttachments::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(ArticleCategories::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTagsAssigns()
    {
        return $this->hasMany(ArticleTagsAssign::className(), ['item_id' => 'id']);
    }
    
  
}
