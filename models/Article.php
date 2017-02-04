<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\article\models;

use Yii;
use yii\db\ActiveRecord;
use yuncms\tag\models\Tag;
use yuncms\system\models\Category;

/**
 * Class Article
 * @package yuncms\article\models
 */
class Article extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'tag' => [
                'class' => 'yuncms\tag\behaviors\TagBehavior',
                'tagValuesAsArray' => true,
                'tagRelation' => 'tags',
                'tagValueAttribute' => 'id',
                'tagFrequencyAttribute' => 'frequency',
            ],
            'category' => [
                'class' => 'yuncms\system\behaviors\CategoryBehavior',
                'categoryValuesAsArray' => true,
                'categoryRelation' => 'categories',
                'categoryValueAttribute' => 'id',
                'categoryFrequencyAttribute' => 'frequency',
            ],
        ];
    }

    public function isActive()
    {
        return $this->status == static::STATUS_ACTIVE;
    }

    /**
     * 是否是作者
     * @return bool
     */
    public function isAuthor()
    {
        return $this->user_id == Yii::$app->user->id;
    }

    /**
     * Category Relation
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%article_category}}', ['stream_id' => 'id']);
    }

    /**
     * Tag Relation
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%article_tag}}', ['stream_id' => 'id']);
    }

    /**
     * Data Relation
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(ArticleData::className(), ['article_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => Yii::t('article','Status Pending'),
            self::STATUS_ACTIVE => Yii::t('article','Status Active'),
        ];
    }

}