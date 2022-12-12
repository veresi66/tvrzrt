<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221207_080703_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->null(),
            'accessToken' => $this->string()->null(),
            'fullName' => $this->string(50)->notNull(),
            'accessFrom' => $this->dateTime()->notNull(),
            'accessTo' => $this->dateTime()->notNull(),
            'permission' => $this->integer()->notNull()->defaultValue(0),
        ],'ENGINE=InnoDB');

        $this->insert('{{%user%}}', [
            'username' => 'admin',
            'password' => '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'fullName' => 'Adminisztrátor',
            'accessFrom' => '2022-12-01 00:00:00',
            'accessTo' => '2099-12-31 23:59:59',
            'permission' => 9,
        ]);
        $this->insert('{{%user%}}', [
            'username' => 'demo',
            'password' => '2a97516c354b68848cdbd8f54a226a0a55b21ed138e207ad6c5cbb9c00aa5aea',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'fullName' => 'Demo felhasználó',
            'accessFrom' => '2022-12-01 00:00:00',
            'accessTo' => '2099-12-31 23:59:59',
            'permission' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
