<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\PaymentsCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetPaymentsQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : PaymentsCollectionDto
    {
        $sql = 'SELECT a.id, a.added, d.name, a.value AS amount, "PLN" AS currency, a.status
                FROM `action` a
                JOIN definition d ON (d.id = a.definition_id)
                WHERE d.user_id = :user_id';
        $payments = $dbal->fetchAll($sql, [
            ':user_id' => $this->userId
        ]);

        return new PaymentsCollectionDto($payments);
    }
}
