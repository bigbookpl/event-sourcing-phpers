<?php

use Prooph\EventSourcing\AggregateChanged;

class UserWasRenamed extends AggregateChanged
{
    public static function create(\Ramsey\Uuid\Uuid $uuid, string $oldName, string $newName)
    {
        return new self($uuid, ['old_name' => $oldName, 'new_name' => $newName]);
    }

    public function newName(): string
    {
        return $this->payload['new_name'];
    }

    public function oldName(): string
    {
        return $this->payload['old_name'];
    }
}