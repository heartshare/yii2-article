<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170119102205Create_article_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%article_tag}}', [
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
        $this->createIndex('article_id','{{%article_tag}}','article_id');
        $this->createIndex('tag_id','{{%article_tag}}','tag_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%article_tag}}');
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
