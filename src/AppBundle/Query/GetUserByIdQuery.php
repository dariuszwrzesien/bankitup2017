<?php

namespace AppBundle\Query;

use AppBundle\Query\Dto\MyUserProfileDto;
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

    public function execute(Dbal $dbal) : MyUserProfileDto
    {
        $sql = 'SELECT u.guid, u.profile_name, u.profile_description, u.profile_email, u.profile_icon_color,
                i.account_id AS incoming_account_id, o.account_id AS outgoing_account_id FROM user AS u
                LEFT JOIN default_user_incoming_account AS i ON u.id = i.user_id
                LEFT JOIN default_user_outgoing_account AS o ON u.id = o.user_id
                WHERE u.id = :id';
        $user = $dbal->fetchAssoc($sql, [':id' => $this->userId]);

        if (!$user) {
            throw new UserDoesNotExistException($this->userId);
        }

        return new MyUserProfileDto($user);
    }
}
