<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m230524_194000_create_feedback_table extends Migration
{
    public $table_name = '{{feedback}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'comment' => $this->string(2000)->notNull(),
            'file_name' => $this->string(255),
            'ip' => $this->string(15),
            'created_at' => $this->string(50)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
