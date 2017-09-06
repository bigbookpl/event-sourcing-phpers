<?php
namespace Librarian\Charging\Domain\Event;

use Money\Money;
use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\UuidInterface;

class AccountCharged extends AggregateChanged
{
    public static function create(UuidInterface $id, Money $money){
        return static::occur(
            $id->toString(),
            [
                'amount' => $money->getAmount() ,
                'currency' => $money->getCurrency()->getCode() ,
            ]
        );
    }


    public function money()
    {
        return new Money(
            $this->payload['amount'],
            new \Money\Currency($this->payload['currency'])
        );
    }

    public function user():string {
        return "Hello world";
    }
}