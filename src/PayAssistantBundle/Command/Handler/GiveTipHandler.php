<?php

namespace PayAssistantBundle\Command\Handler;

use PayAssistantBundle\Command\GiveTipCommand;
use PayAssistantBundle\Entity\Tip;
use PayAssistantBundle\Event\GiveTipEvent;
use PayAssistantBundle\Repository\TipRepositoryInterface;
use PayAssistantBundle\Repository\UserRepositoryInterface;
use CqrsBundle\Commanding\CommandHandlerInterface;
use CqrsBundle\Eventing\EventBusInterface;

class GiveTipHandler implements CommandHandlerInterface
{
    private $eventBus;
    private $tipRepository;
    private $userRepository;

    public function __construct(
        EventBusInterface $eventBus,
        TipRepositoryInterface $tipRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->eventBus = $eventBus;
        $this->tipRepository = $tipRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(GiveTipCommand $command) : void
    {
        $sender = $this->userRepository->getById($command->senderId());
        $recipient = $this->userRepository->getByGuid($command->recipientGuid());

        $tip = new Tip();
        $tip->setSender($sender);
        $tip->setRecipient($recipient);
        $tip->setAmount($command->amount());
        $tip->setMessage($command->message());
        $tip->setGiven($command->given());

        $this->tipRepository->add($tip);
        $this->eventBus->raise(new GiveTipEvent(
            $tip->getId(),
            $tip->getSender()->getId(),
            $tip->getRecipient()->getId(),
            $tip->getAmount(),
            $tip->getMessage(),
            $tip->getGiven()
        ));
    }
}
