<?php

require_once __DIR__.'/vendor/autoload.php';

$config = new Configuration();

$connectionParams = [
    'dbname' => 'prooph_example',
    'user' => 'root',
    'password' => 'test',
    'host' => '127.0.0.1',
    'port' => '32775',
    'driver' => 'pdo_mysql',
];

$messageFactory = \Prooph\Common\Messaging\FQCNMessageFactory::class

$eventStore = new \Prooph\EventStore\Pdo\MySqlEventStore($messageFactory, $connection, $persistenceStrategy)