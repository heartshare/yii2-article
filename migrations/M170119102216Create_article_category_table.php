<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170119102216Create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%article_category}}', [
            'article_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
        $this->createIndex('article_id','{{%article_category}}','article_id');
        $this->createIndex('category_id','{{%article_category}}','category_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%article_category}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
