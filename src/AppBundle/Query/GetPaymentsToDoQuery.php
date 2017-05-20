<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\PaymentsToDoCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;
use PayAssistantBundle\Entity\Action;

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
                WHERE d.user_id = :user_id AND a.status = :status';
        $payments = $dbal->fetchAll($sql, [
            ':user_id' => $this->userId,
            ':status' => Action::STATUS_TODO
        ]);

        return new PaymentsToDoCollectionDto($payments);
    }
}
