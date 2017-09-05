<?php
namespace Librarian\Charging\Domain\Event;

use Money\Currency;
use Prooph\EventSourcing\AggregateChanged;

class AccountCreated extends AggregateChanged
{
    public static function create(\Ramsey\Uuid\UuidInterface $id, \Money\Currency $currency){
        return static::occur(
            $id->toString(),
            ['currency' => $currency->getCode()]
        );
    }

    public function currency()
    {
        return new Currency($this->payload['currency']);
    }
}