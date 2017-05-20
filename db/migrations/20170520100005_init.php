<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Init extends AbstractMigration
{
    public function up()
    {
        $this->createUserTable();
    }

    public function down()
    {
        $this->removeUserTable();
    }

    private function createUserTable()
    {
        $this->table('user')
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 100])
            ->addColumn('display_name', 'string', ['limit' => 100])
            ->addColumn('auth_token_key', 'text', ['null' => true, 'limit' => MysqlAdapter::TEXT_REGULAR])
            ->create();
    }

    private function removeUserTable()
    {
        $this->table('user')
            ->drop();
    }
}
