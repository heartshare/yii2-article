<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\article\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article_data}}".
 *
 * @property int $id
 * @property string $content
 * @property integer $markdown
 *
 * @property Article $article
 */
class ArticleData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'filter', 'filter' => 'trim'],
        ];
    }

    /**
     * Data Relation
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}