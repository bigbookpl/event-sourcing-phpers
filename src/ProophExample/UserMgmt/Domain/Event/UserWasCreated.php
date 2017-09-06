<?php


use Prooph\EventSourcing\AggregateChanged;

class UserWasCreated extends AggregateChanged
{

    public static function create($uuid, $name)
    {
        return static::occur($uuid, ['name' => $name]);
    }

    public function username()
    {
        return $this->payload['name'];
    }

    //raczej dodac metode name()
}