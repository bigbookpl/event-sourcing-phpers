<?php
namespace Librarian\Charging\Domain\Event;

use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\UuidInterface;

class AccountActivated extends AggregateChanged
{
    public static function create(UuidInterface $id){
        return static::occur(
            $id->toString()
        );
    }
}