<?php

namespace ProophExample\UserMgmt\Infrastructure;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;
use ProophExample\UserMgmt\Domain\User;
use ProophExample\UserMgmt\Domain\UserRepository;
use Ramsey\Uuid\Uuid;

class UserRepositoryImpl  implements UserRepository
{
    /**
     * @var AggregateRepository
     */
    private $repository;

    /**
     * UserRepositoryImp constructor.
     */
    public function __construct(EventStore $eventStore)
    {
        $this->repository = new AggregateRepository(
            $eventStore,
            AggregateType::fromAggregateRootClass(User::class),
            new AggregateTranslator()
        );
    }

    public function get(Uuid $uuid): ?User
    {
        return $this->repository->getAggregateRoot($uuid->toString());
    }

    public function save(User $user): void
    {
        $this->repository->saveAggregateRoot($user);
    }
}