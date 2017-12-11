<?php

use yii\db\Migration;

class m171211_080940_app_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('area', [
            'id' => $this->primaryKey(),
            'area_name' => $this->string(50)->notNull()->defaultValue('')->comment('区域名称'),
            'parent_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('父ID'),
            'area_type' => $this->boolean()->notNull()->defaultValue(1)->comment('区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('area');
    }
}
