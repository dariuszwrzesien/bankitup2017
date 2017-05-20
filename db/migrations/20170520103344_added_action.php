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

        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('definition_id', 'integer', ['null' => true])
            ->addColumn('value', 'integer')
            ->addColumn('status', 'string', ['limit' => 255])
            ->create();

        $table->addForeignKey('definition_id', 'definition', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->save();
    }

    private function removeActionTable()
    {
        $this->table('action')
            ->drop();
    }
}
