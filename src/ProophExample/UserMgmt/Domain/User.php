<?php

declare(strict_types=1);

namespace ProophExample\UserMgmt\Domain;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;

class User extends \Prooph\EventSourcing\AggregateRoot
{

    private $uuid;
    private $name;

    public static function create(string $name): User
    {
        $uuid = Uuid::uuid4();

        $instance = new self();

        $instance->recordThat(UserWasCreated::create($uuid, $name));

        return $instance;
    }

    public function changeName(string $newName): void
    {
        Assertion::notEmpty($newName);

        if ($newName !== $this->name){
            $this->recordThat(UserWasRenamed::create($this->uuid, $this->name, $newName));
        }
    }

    protected function aggregateId(): string
    {
        return $this->uuid;
    }

    /**
     * Apply given event
     *
     * W tej metodzie kazdy event dla agregatu zmienia jego stan
     */
    protected function apply(\Prooph\EventSourcing\AggregateChanged $event): void
    {
        switch (get_class($event)) {
            case UserWasCreated::class:
                /** @var UserWasCreated $event */
                $this->uuid = Uuid::fromString($event->aggregateId());
                $this->name = $event->name();
                break;
            case UserWasRenamed::class:
                /** @var UserWasRenamed $event */
                $this->name = $event->newName();
                break;
        }
    }
}