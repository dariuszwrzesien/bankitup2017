<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\UserTotalGivenCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetTotalTipsGivenPerMonthForUserIdQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : UserTotalGivenCollectionDto
    {
        $sql = 'SELECT SUM(amount) AS total, COUNT(*) as given, DATE_FORMAT(given, \'%Y-%m\') as `date` 
          FROM tip 
          WHERE sender_id = :id 
          GROUP BY DATE_FORMAT(given, \'%Y-%m\')';
        $given = $dbal->fetchAll($sql, [':id' => $this->userId]);

        return new UserTotalGivenCollectionDto($given);
    }
}
