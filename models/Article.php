<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\article\models;

use Yii;
use yii\helpers\StringHelper;
use yii\db\ActiveRecord;
use yuncms\tag\models\Tag;
use yuncms\system\models\Category;

/**
 * Class Article
 *
 * @property int $id
 *
 * @property ArticleData $data
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
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior'
            ],
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
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'cover', 'description'], 'filter', 'filter' => 'trim'],
            ['is_top', 'boolean'],
            ['is_hot', 'boolean'],
            ['is_best', 'boolean'],
            ['is_top', 'default', 'value' => false],
            ['is_hot', 'default', 'value' => false],
            ['is_best', 'default', 'value' => false],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PENDING]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('article', 'Title'),
            'description' => Yii::t('article', 'Description'),
            'cover' => Yii::t('article', 'Cover'),
            'status' => Yii::t('article', 'Status'),
            'comments' => Yii::t('article', 'Comments'),
            'views' => Yii::t('article', 'Views'),
            'is_top' => Yii::t('article', 'Is Top'),
            'is_hot' => Yii::t('article', 'Is Hot'),
            'is_best' => Yii::t('article', 'Is Best'),
            'content' => Yii::t('article', 'Content'),
            'created_at' => Yii::t('article', 'Created At'),
            'updated_at' => Yii::t('article', 'Updated At'),
            'published_at' => Yii::t('article', 'Published At'),
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
     * 设置发布状态
     * @return int
     */
    public function setPublished()
    {
        return $this->updateAttributes(['status' => static::STATUS_ACTIVE, 'published_at' => time()]);
    }

    /**
     * Category Relation
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%article_category}}', ['article_id' => 'id']);
    }

    /**
     * Tag Relation
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%article_tag}}', ['article_id' => 'id']);
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
            self::STATUS_PENDING => Yii::t('article', 'Status Pending'),
            self::STATUS_ACTIVE => Yii::t('article', 'Status Active'),
        ];
    }

    /**
     * 保存后生成短网址
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->updateAttributes(['key' => $this->generateKey()]);
        }
        if(empty($this->description)){
            $content = $this->getData()->content;
            $this->updateAttributes(['description' => StringHelper::byteSubstr(strip_tags($content), 0, 100)]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * 生成key
     */
    protected function generateKey()
    {
        $result = sprintf("%u", crc32($this->id));
        $key = '';
        while ($result > 0) {
            $s = $result % 62;
            if ($s > 35) {
                $s = chr($s + 61);
            } elseif ($s > 9 && $s <= 35) {
                $s = chr($s + 55);
            }
            $key .= $s;
            $result = floor($result / 62);
        }
        return $key;
    }

    public function afterDelete()
    {
        ArticleData::deleteAll(['article_id' => $this->id]);
        parent::afterDelete();
    }
}