<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\UserProfileDto;
use CqrsBundle\Querying\QueryInterface;
use Doctrine\DBAL\Connection as Dbal;
use PayAssistantBundle\Exception\UserDoesNotExistException;

class GetUserByGuidQuery implements QueryInterface
{
    private $guid;

    public function __construct(string $guid)
    {
        $this->guid = $guid;
    }

    public function execute(Dbal $dbal) : UserProfileDto
    {
        $sql = 'SELECT profile_name, profile_description, profile_icon_color FROM user WHERE guid = :guid LIMIT 1';
        $user = $dbal->fetchAssoc($sql, [':guid' => $this->guid]);

        if (!$user) {
            throw new UserDoesNotExistException($this->guid);
        }

        return new UserProfileDto($user);
    }
}
