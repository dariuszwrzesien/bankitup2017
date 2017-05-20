<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\PaymentsToDoCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetPaymentsToDoQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : PaymentsToDoCollectionDto
    {
        $sql = 'SELECT a.id, a.added, d.name, a.value AS amount, "PLN" AS currency
                FROM `action` a
                JOIN definition d ON (d.id = a.definition_id)
                WHERE d.user_id = :user_id';
        $tips = $dbal->fetchAll($sql, [':user_id' => $this->userId]);

        return new PaymentsToDoCollectionDto($tips);
    }
}
