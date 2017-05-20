<?php

use Phinx\Seed\AbstractSeed;

class DefinitionSeeder extends AbstractSeed
{
    private $definitions = [
        [
            'id' => 1,
            'name' => 'Płatność za faturę PLAY.',
            'transfer_iban' => 'PL61109010140000071219812874',
            'transfer_title' => 'Opłata za fakturę numer: 1234.',
        ],
        [
            'id' => 2,
            'name' => 'Opłata za czynsz.',
            'transfer_iban' => 'PL71109010140000071219812875',
            'transfer_title' => 'Czynsz za miesiąc maj.',
        ],
        [
            'id' => 3,
            'name' => 'Zakup domeny.',
            'transfer_iban' => 'PL81109010140000071219812876',
            'transfer_title' => 'Opłata za zakup domeny payasisstant.pl.',
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
