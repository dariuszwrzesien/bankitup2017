<?php

use Phinx\Seed\AbstractSeed;

class DefinitionSeeder extends AbstractSeed
{
    private $definitions = [
        [
            'id' => 1,
            'name' => 'Płatność za faturę PLAY.',
            'transferIban' => 'PL61109010140000071219812874',
            'transferTitle' => 'Opłata za fakturę numer: 1234.',
        ],
        [
            'id' => 2,
            'name' => 'Opłata za czynsz.',
            'transferIban' => 'PL71109010140000071219812875',
            'transferTitle' => 'Czynsz za miesiąc maj.',
        ],
        [
            'id' => 3,
            'name' => 'Zakup domeny.',
            'transferIban' => 'PL81109010140000071219812876',
            'transferTitle' => 'Opłata za zakup domeny payasisstant.pl.',
        ],
    ];

    public function run()
    {
        $table = $this->table('definition');

        foreach ($this->definitions as $definition) {
            $table->insert($definition)->save();
        }
    }
}
