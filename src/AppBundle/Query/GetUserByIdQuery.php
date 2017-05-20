<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\UserProfileDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;
use PayAssistantBundle\Exception\UserDoesNotExistException;

class GetUserByIdQuery implements QueryInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute(Dbal $dbal) : UserProfileDto
    {
        $sql = 'SELECT u.email, u.display_name AS name
                FROM user AS u
                WHERE u.id = :userId';
        $user = $dbal->fetchAssoc($sql, [':userId' => $this->userId]);

        if (!$user) {
            throw new UserDoesNotExistException($this->userId);
        }

        return new UserProfileDto($user);
    }
}
