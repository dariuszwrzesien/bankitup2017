<?php

use Phinx\Seed\AbstractSeed;
use PayAssistantBundle\Entity\Action;

class ActionSeeder extends AbstractSeed
{
    private $actions = [
        [
            'id' => 1,
            'definition_id' => 1,
            'value' => 1000,
            'status' => Action::STATUS_TODO,
        ],
        [
            'id' => 2,
            'definition_id' => 2,
            'value' => 5000,
            'status' => Action::STATUS_TODO,
        ],
        [
            'id' => 3,
            'definition_id' => 3,
            'value' => 500,
            'status' => Action::STATUS_TODO,
        ]
    ];

    public function run()
    {
        $table = $this->table('action');

        foreach ($this->actions as $action) {
            $table->insert($action)->save();
        }
    }
}
