<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170119085642Create_article_data_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_data}}', [
            'article_id' => $this->integer(11)->notNull(),
            'content' => $this->text()->notNull()->comment('内容'),
            'markdown' => $this->boolean()->notNull()->defaultValue(false)->comment('是否markdown格式'),
        ], $tableOptions);
        $this->addPrimaryKey('pk','{{%article_data}}','article_id');
        $this->addForeignKey('fk', '{{%article_data}}', 'article_id', '{{%article}}', 'id', 'CASCADE', 'CASCADE');


    }

    public function down()
    {
        $this->dropTable('{{%article_data}}');
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
