<?php

namespace Librarian\Charging\Domain\Event;


use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\UuidInterface;

class DebitCanceled extends AggregateChanged
{
    public static function create(UuidInterface $id, $reason)
    {
        return static::occur(
            $id->toString(),
            [
                'reason' => $reason,
            ]
        );
    }

}