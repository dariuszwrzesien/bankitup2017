<?php

use Phinx\Migration\AbstractMigration;

class AddedDefinition extends AbstractMigration
{

    public function up()
    {
        $this->createDefinitionTable();
    }

    public function down()
    {
        $this->removeDefinitionTable();
    }

    private function createDefinitionTable()
    {
        $table = $this->table('definition');

        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('transfer_iban', 'string', ['limit' => 50])
            ->addColumn('transfer_title', 'string', ['limit' => 250])
            ->addColumn('user_id', 'integer')
            ->create();

        $table->addForeignKey('user_id', 'user', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->save();
    }

    private function removeDefinitionTable()
    {
        $this->table('definition')
            ->drop();
    }
}
