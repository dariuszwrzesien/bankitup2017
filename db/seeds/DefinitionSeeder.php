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
            'user_id' => 1
        ],
        [
            'id' => 2,
            'name' => 'Opłata za czynsz.',
            'transfer_iban' => 'PL71109010140000071219812875',
            'transfer_title' => 'Czynsz za miesiąc maj.',
            'user_id' => 1
        ],
        [
            'id' => 3,
            'name' => 'Zakup domeny.',
            'transfer_iban' => 'PL81109010140000071219812876',
            'transfer_title' => 'Opłata za zakup domeny payasisstant.pl.',
            'user_id' => 1
        ],
        [
            'id' => 4,
            'name' => 'Opłata za sprzedaż na Allegro.',
            'transfer_iban' => 'PL91109010140000071219812877',
            'transfer_title' => 'Prowizja allegro.',
            'user_id' => 1
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
