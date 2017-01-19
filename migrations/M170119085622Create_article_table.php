<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170119085622Create_article_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(80)->notNull()->comment('标题'),
            //'category' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT '分类'",
            //'category_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",

            'status' => $this->boolean()->defaultValue(false)->comment('状态'),
            'cover' => $this->string()->comment('封面'),
            'comments' => $this->integer()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'is_top' => $this->boolean()->notNull()->defaultValue(false)->comment('是否置顶'),
            'is_hot' => $this->boolean()->notNull()->defaultValue(false)->comment('是否热门'),
            'is_best' => $this->boolean()->notNull()->defaultValue(false)->comment('是否精华'),
            'description' => $this->string()->comment('描述'),
            'user_id' => $this->integer()->notNull()->defaultValue(0),
            //'source' => Schema::TYPE_STRING . "(255) NOT NULL DEFAULT ''",
            //'deleted_at' => Schema::TYPE_INTEGER . "(10)",
            //'favourite' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
            'published_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        $this->createIndex('index_published_at', '{{%article}}', 'published_at');

    }

    public function down()
    {
        $this->dropTable('{{%article}}');
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
