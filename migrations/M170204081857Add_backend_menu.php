<?php

namespace yuncms\article\migrations;

use yii\db\Migration;

class M170204081857Add_backend_menu extends Migration
{
    public function up()
    {
        $this->insert('{{%admin_menu}}', [
            'name' => '文章管理',
            'parent' => 8,
            'route' => '/article/article/index',
            'icon' => 'fa-file-text-o',
            'sort' => NULL,
            'data' => NULL
        ]);

        $id = (new \yii\db\Query())->select(['id'])->from('{{%admin_menu}}')->where(['name' => '文章管理', 'parent' => 8,])->scalar($this->getDb());
        $this->batchInsert('{{%admin_menu}}', ['name', 'parent', 'route', 'visible', 'sort'], [

            ['文章查看', $id, '/article/article/view', 0, NULL],
            ['创建文章', $id, '/article/article/create', 0, NULL],
            ['更新文章', $id, '/article/article/update', 0, NULL],
        ]);
    }

    public function down()
    {
        $id = (new \yii\db\Query())->select(['id'])->from('{{%admin_menu}}')->where(['name' => '文章管理', 'parent' => 8,])->scalar($this->getDb());
        $this->delete('{{%admin_menu}}', ['parent' => $id]);
        $this->delete('{{%admin_menu}}', ['id' => $id]);
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
