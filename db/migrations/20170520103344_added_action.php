<?php

use Phinx\Migration\AbstractMigration;

class AddedAction extends AbstractMigration
{
    public function up()
    {
        $this->createActionTable();
    }

    public function down()
    {
        $this->removeActionTable();
    }

    public function createActionTable()
    {
        $table = $this->table('action');

        $table->addColumn('definition_id', 'integer', ['null' => true])
            ->addColumn('added', 'datetime')
            ->addColumn('paid', 'datetime', ['null' => true])
            ->addColumn('value', 'integer')
            ->addColumn('status', 'string', ['limit' => 20])
            ->create();

        $table->addForeignKey('definition_id', 'definition', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->save();
    }

    private function removeActionTable()
    {
        $this->table('action')
            ->drop();
    }
}
