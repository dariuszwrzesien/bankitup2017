<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    private $users = [
        [
            'id' => 1,
            'email' => 'apietka@future-processing.com',
            'password' => 'apietka',
            'display_name' => 'Adrian',
            'auth_token_key' => null
        ],
        [
            'id' => 2,
            'email' => 'dwrzesien@future-processing.com',
            'password' => 'dwrzesien',
            'display_name' => 'Dariusz',
            'auth_token_key' => null
        ],
        [
            'id' => 3,
            'email' => 'mtarnaski@future-processing.com',
            'password' => 'mtarnaski',
            'display_name' => 'Mateusz',
            'auth_token_key' => null
        ]
    ];

    public function run()
    {
        $table = $this->table('user');

        foreach ($this->users as $user) {
            $table->insert($user)->save();
        }
    }
}
