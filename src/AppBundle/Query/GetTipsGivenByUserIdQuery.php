<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\TipsGivenByUserCollectionDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;

class GetTipsGivenByUserIdQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : TipsGivenByUserCollectionDto
    {
        $sql = 'SELECT tip.given, tip.amount, tip.message, u.profile_name AS recipient_name, u.profile_icon_color AS recipient_color FROM tip
                LEFT JOIN user AS u ON tip.recipient_id = u.id
                WHERE sender_id = :id';
        $tips = $dbal->fetchAll($sql, [':id' => $this->userId]);

        return new TipsGivenByUserCollectionDto($tips);
    }
}
