<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\UserTotalReceivedCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetTotalTipsReceivedPerMonthForUserIdQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : UserTotalReceivedCollectionDto
    {
        $sql = 'SELECT SUM(amount) AS total, COUNT(*) as received, DATE_FORMAT(given, \'%Y-%m\') as `date` 
          FROM tip 
          WHERE recipient_id = :id 
          GROUP BY DATE_FORMAT(given, \'%Y-%m\')';
        $received = $dbal->fetchAll($sql, [':id' => $this->userId]);

        return new UserTotalReceivedCollectionDto($received);
    }
}
