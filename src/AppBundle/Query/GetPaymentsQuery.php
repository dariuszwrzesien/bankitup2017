<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\PaymentsCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;
use PayAssistantBundle\Entity\Action;

class GetPaymentsQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : PaymentsCollectionDto
    {
        $sql = 'SELECT a.id, a.added, a.paid, d.name, a.value AS amount, "PLN" AS currency, a.status,
                IF(a.added < :currentDate AND a.status = :todoStatus,1,0) AS overdeal
                FROM `action` a
                JOIN definition d ON (d.id = a.definition_id)
                WHERE d.user_id = :user_id
                ORDER BY added DESC';

        $payments = $dbal->fetchAll($sql, [
            ':user_id' => $this->userId,
            ':todoStatus' => Action::STATUS_TODO,
            ':currentDate' => (new \DateTime())->format('Y-m-d')
        ]);

        return new PaymentsCollectionDto($payments);
    }
}
