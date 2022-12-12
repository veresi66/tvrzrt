<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workers}}`.
 */
class m221207_080309_create_workers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'identification_number' => $this->string()->notNull(),
            'position' => $this->string()->notNull(),
            'evaluator_id' => $this->integer(),
            'evaluator' =>$this->boolean()->notNull()->defaultValue(false),
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx_workers_evaluator_id',
            '{{%workers}}',
            'evaluator_id'
        );

        $this->addForeignKey(
            'fk_workers_evaluator_id',
            '{{%workers}}',
            'evaluator_id',
            '{{%workers}}',
            'id',
            'SET NULL'
        );
    
        $this->insert('{{%workers%}}', [
            'id' => 1,
            'name' => 'Teszt Elek',
            'identification_number' => 'Teszt001',
            'position' => 'Vezérigazgató',
            'evaluator_id' => null,
            'evaluator' => 0,
        ]);
        $this->insert('{{%workers%}}', [
            'id' => 2,
            'name' => 'Teszt Aladár',
            'identification_number' => 'Teszt002',
            'position' => 'Osztályvezető',
            'evaluator_id' => 1,
            'evaluator' => 0,
        ]);
        $this->insert('{{%workers%}}', [
            'id' => 3,
            'name' => 'Teszt Béla',
            'identification_number' => 'Teszt003',
            'position' => 'Osztályvezető',
            'evaluator_id' => 1,
            'evaluator' => 0,
        ]);
        $this->insert('{{%workers%}}', [
            'id' => 4,
            'name' => 'Teszt Cecília',
            'identification_number' => 'Teszt004',
            'position' => 'Gépszerelő',
            'evaluator_id' => 2,
            'evaluator' => 0,
        ]);
        $this->insert('{{%workers%}}', [
            'id' => 5,
            'name' => 'Teszt Dömötör',
            'identification_number' => 'Teszt005',
            'position' => 'Betanított munkás',
            'evaluator_id' => 2,
            'evaluator' => 0,
        ]);
        $this->insert('{{%workers%}}', [
            'id' => 6,
            'name' => 'Teszt Elekné',
            'identification_number' => 'Teszt006',
            'position' => 'adminisztrátor',
            'evaluator_id' => 3,
            'evaluator' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workers}}');
    }
}
