<?php

namespace PayAssistantBundle\Command\Handler;

use PayAssistantBundle\Command\ConnectUserCommand;
use PayAssistantBundle\Entity\User;
use PayAssistantBundle\Repository\UserRepositoryInterface;
use CqrsBundle\Commanding\CommandHandlerInterface;
use CqrsBundle\Eventing\EventBusInterface;

class ConnectUserHandler implements CommandHandlerInterface
{
    private $eventBus;
    private $userRepository;

    public function __construct(
        EventBusInterface $eventBus,
        UserRepositoryInterface $userRepository
    ) {
        $this->eventBus = $eventBus;
        $this->userRepository = $userRepository;
    }

    public function handle(ConnectUserCommand $command) : void
    {
        $bankBag = $command->bankBag();
        $user = $this->userRepository->getByBankUserId($bankBag->getUserId());

        if (!$user) {
            $user = (new User())
                ->setGuid(uniqid('', true))
                ->setBankUserId($bankBag->getUserId())
                ->setBankUserName($bankBag->getUserName())
                ->setProfileName(explode(' ', $bankBag->getUserName())[0])
                ->setProfileEmail($bankBag->getEmail())
                ->setProfileIconColor('#2196f3');
        }

        $user->setTokenKey($command->tokenKey())
            ->setBankTokenAccess($bankBag->getTokenAccess())
            ->setBankTokenSecretAccess($bankBag->getTokenSecretAccess());

        if (!$user->getId()) {
            $this->userRepository->add($user);
        }
    }
}
