<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\Pdo\MySqlEventStore;
use Prooph\EventStore\Stream;
use ProophExample\UserMgmt\Domain\User;
use ProophExample\UserMgmt\Infrastructure\UserRepositoryImpl;

require_once __DIR__.'/vendor/autoload.php';

$config = new Configuration();

$connectionParams = [
    'dbname' => 'prooph_example',
    'user' => 'root',
    'password' => 'test',
    'host' => '127.0.0.1',
    'port' => '32768',
    'driver' => 'pdo_mysql',
];

$messageFactory = new FQCNMessageFactory();
$connection = DriverManager::getConnection($connectionParams);
$persistenceStrategy = new Prooph\EventStore\Pdo\PersistenceStrategy\MySqlSingleStreamStrategy();
$streamName = new \Prooph\EventStore\StreamName("event_stream");

$stream = new Stream($streamName, new ArrayIterator());

$eventStore = new MySqlEventStore($messageFactory, $connection->getWrappedConnection(), $persistenceStrategy);

if (!$eventStore->hasStream($streamName)) {
    $eventStore->create($stream);
}

$userReporsitory = new UserRepositoryImpl($eventStore);

$user = User::create("Maciek z Klanu");
$user->changeName("Bożenka z Klanu 1");
$user->changeName("Bożenka z Klanu 2");
$user->changeName("Bożenka z Klanu 3");
$user->changeName("Bożenka z Klanu 4");
$user->changeName("Bożenka z Klanu 5");

$userReporsitory->save($user);

$userReporsitory->get($user->id());
