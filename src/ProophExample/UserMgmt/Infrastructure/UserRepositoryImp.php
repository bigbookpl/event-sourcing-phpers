<?php


use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;
use ProophExample\UserMgmt\Domain\User;
use ProophExample\UserMgmt\Domain\UserRepository;
use Ramsey\Uuid\Uuid;

class UserRepositoryImp extends AggregateRepository implements UserRepository
{

    /**
     * UserRepositoryImp constructor.
     */
    public function __construct(EventStore $eventStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(User::class),
            new AggregateTranslator()
        );
    }

    public function get(Uuid $uuid): ?User
    {
        return $this->getAggregateRoot($uuid->toString());
    }

    public function save(User $user): void
    {
        $this->saveAggregateRoot($user);
    }
}