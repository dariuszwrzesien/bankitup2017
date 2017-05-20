<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\TipsReceivedByUserCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetTipsReceivedByUserIdQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : TipsReceivedByUserCollectionDto
    {
        $sql = 'SELECT * FROM tip WHERE recipient_id = :id';
        $tips = $dbal->fetchAll($sql, [':id' => $this->userId]);

        return new TipsReceivedByUserCollectionDto($tips);
    }
}
