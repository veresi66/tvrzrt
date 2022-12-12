<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kpi}}`.
 */
class m221209_081321_create_kpi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kpi}}', [
            'id' => $this->primaryKey(),
            'kpi' => $this->string()->notNull(),
        ], 'ENGINE=InnoDB');
        
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 1' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 2' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 3' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 4' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 5' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 6' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 7' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 8' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 9' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 10' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 11' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 12' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 13' ]);
        $this->insert('{{%kpi}}', ['kpi' => 'Teszt feladat 14' ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kpi}}');
    }
}
