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
            'added' => '2017-05-20 10:12'
        ],
        [
            'id' => 2,
            'definition_id' => 2,
            'value' => 5000,
            'status' => Action::STATUS_TODO,
            'added' => '2017-05-20 13:36'
        ],
        [
            'id' => 3,
            'definition_id' => 3,
            'value' => 500,
            'status' => Action::STATUS_TODO,
            'added' => '2017-05-20 17:45'
        ],
        [
            'id' => 4,
            'definition_id' => 4,
            'value' => 300,
            'status' => Action::STATUS_PAID,
            'added' => '2017-05-20 00:45'
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
