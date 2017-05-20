<?php

namespace AppBundle\Adapter;

use CqrsBundle\Commanding\CommandBusInterface;
use CqrsBundle\Commanding\CommandHandlerResolverInterface;
use CqrsBundle\Commanding\CommandInterface;
use CqrsBundle\Eventing\EventBusInterface;
use Doctrine\ORM\EntityManager;

class SymfonyCommandBus implements CommandBusInterface
{
    private $handlerResolver;
    private $eventBus;
    private $entityManager;

    public function __construct(
        CommandHandlerResolverInterface $handlerResolver,
        EntityManager $entityManager,
        EventBusInterface $eventBus
    ) {
        $this->handlerResolver = $handlerResolver;
        $this->eventBus = $eventBus;
        $this->entityManager = $entityManager;
    }

    public function handle(CommandInterface $command) : void
    {
        $handler = $this->handlerResolver->handler($command);
        $handler->handle($command);
        $this->entityManager->flush();

        foreach ($this->eventBus->getRaised() as $event) {
            $this->eventBus->dispatch($event);
            $this->entityManager->flush();
        }
    }
}
