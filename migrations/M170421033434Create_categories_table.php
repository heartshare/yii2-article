<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170421033434Create_categories_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_categories}}', [
            'id' => $this->primaryKey(),
            'parent' => $this->integer(),
            'name' => $this->string()->notNull()->comment('名字'),
            'slug' => $this->string(50),
            'keywords' => $this->string(),
            'description' => $this->string(1000)->defaultValue(''),
            'letter' => $this->string(1),
            'frequency' => $this->integer()->notNull()->defaultValue(0),
            'sort' => $this->smallInteger(5)->notNull()->defaultValue(0),
            'allow_publish' => $this->boolean()->defaultValue(true)->comment('是否允许发布内容'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('{{%article_categories_fk}}', '{{%article_categories}}', 'parent', '{{%article_categories}}', 'id', 'SET NULL', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%article_categories}}');
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
