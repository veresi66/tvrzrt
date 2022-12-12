<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%evaluation}}`.
 */
class m221209_081436_create_evaluation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%evaluation}}', [
            'id' => $this->primaryKey(),
            'kpi_id' => $this->integer()->notNull(),
            'worker_id' => $this->integer()->notNull(),
            'priority' => "ENUM('1', '2', '3') NOT NULL",
            'condition' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'result' => "ENUM('0', '20', '40', '60', '80', '100')"
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx_evaluation_kpi',
            '{{%evaluation}}',
            'kpi_id'
        );

        $this->createIndex(
            'idx_evaluation_worker',
            '{{%evaluation}}',
            'worker_id'
        );

        $this->addForeignKey(
            'fk_workers_evaluation',
            '{{%evaluation}}',
            'worker_id',
            'workers',
            'id'
        );

        $this->addForeignKey(
            'fk_kpi_evaluation',
            '{{%evaluation}}',
            'kpi_id',
            'kpi',
            'id'
        );
        
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 1,
            'worker_id' => 2,
            'priority' => 1,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 4,
            'worker_id' => 2,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 5,
            'worker_id' => 2,
            'priority' => 2,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 9,
            'worker_id' => 2,
            'priority' => 3,
            'result' => 40
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 1,
            'worker_id' => 3,
            'priority' => 1,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 4,
            'worker_id' => 3,
            'priority' => 1,
            'result' => 60
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 9,
            'worker_id' => 3,
            'priority' => 3,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 11,
            'worker_id' => 3,
            'priority' => 1,
            'result' => 40
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 5,
            'worker_id' => 4,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 6,
            'worker_id' => 4,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 7,
            'worker_id' => 4,
            'priority' => 2,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 8,
            'worker_id' => 4,
            'priority' => 3,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 1,
            'worker_id' => 5,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 8,
            'worker_id' => 5,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 9,
            'worker_id' => 5,
            'priority' => 1,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 10,
            'worker_id' => 5,
            'priority' => 2,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 11,
            'worker_id' => 5,
            'priority' => 3,
            'result' => 80
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 1,
            'worker_id' => 6,
            'priority' => 1,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 10,
            'worker_id' => 6,
            'priority' => 1,
            'result' => 100
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 11,
            'worker_id' => 6,
            'priority' => 1,
            'result' => 40
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 12,
            'worker_id' => 6,
            'priority' => 2,
            'result' => 60
        ]);
        $this->insert('{{%evaluation}}', [
            'kpi_id' => 13,
            'worker_id' => 6,
            'priority' => 3,
            'result' => 100
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%evaluation}}');
    }
}
