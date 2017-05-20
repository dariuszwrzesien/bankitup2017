<?php

namespace PayAssistantBundle\Command\Handler;

use CqrsBundle\Commanding\CommandHandlerInterface;
use CqrsBundle\Eventing\EventBusInterface;
use PayAssistantBundle\Entity\Definition;
use PayAssistantBundle\Repository\DefinitionRepositoryInterface;
use PayAssistantBundle\Command\CreateDefinitionCommand;
use PayAssistantBundle\Event\CreateDefinitionEvent;

class CreateDefinitionHandler implements CommandHandlerInterface
{
    private $eventBus;
    private $definitionRepository;

    public function __construct(
        EventBusInterface $eventBus,
        DefinitionRepositoryInterface $definitionRepository
    ) {
        $this->eventBus = $eventBus;
        $this->definitionRepository = $definitionRepository;
    }

    public function handle(CreateDefinitionCommand $command) : void
    {
        $definition = new Definition();
        $definition->setName($command->name());
        $definition->setTransferIban($command->transferIban());
        $definition->setTransferTitle($command->transferTitle());

        $this->definitionRepository->add($definition);

        $this->eventBus->raise(new CreateDefinitionEvent(
            $definition->getId(),
            $definition->getName(),
            $definition->getTransferIban(),
            $definition->getTransferTitle()
        ));
    }
}
