<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170204041738Add_column_of_user_extend extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_extend}}', 'articles', $this->integer()->unsigned()->defaultValue(0)->comment('文章数'));
    }

    public function down()
    {
        $this->dropColumn('{{%user_extend}}', 'articles');
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
