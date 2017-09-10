<?php

namespace ProophExample\UserMgmt\Domain\Event;

use Prooph\EventSourcing\AggregateChanged;

class UserWasCreated extends AggregateChanged
{

    public static function create($uuid, $name)
    {
        return static::occur($uuid, ['name' => $name]);
    }

    public function name(): string {
        return $this->payload['name'];
    }

}