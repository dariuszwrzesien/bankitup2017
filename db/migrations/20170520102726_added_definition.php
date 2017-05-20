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
        $this->table('definition')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('transferIban', 'string', ['limit' => 50])
            ->addColumn('transferTitle', 'string', ['limit' => 255])
            ->create();
    }

    private function removeDefinitionTable()
    {
        $this->table('definition')
            ->drop();
    }
}
