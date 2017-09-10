<?php
//
//use Doctrine\DBAL\Configuration;
//use Doctrine\DBAL\DriverManager;
//
//require_once __DIR__.'/vendor/autoload.php';
//
//$config = new Configuration();
//\
//$connectionParams = [
//    'dbname' => 'phpers_summit',
//    'user' => 'root',
//    'password' => 'test',
//    'host' => '127.0.0.1',
//    'port' => '32775',
//    'driver' => 'pdo_mysql',
//];
//
//$connection = DriverManager::getConnection($connectionParams, $config);
//
//$eventStore = new \Prooph\EventStore\Pdo\MySqlEventStore(
//    new \Prooph\Common\Messaging\FQCNMessageFactory(),
//    $connection->getWrappedConnection(),
//    new \Prooph\EventStore\Pdo\PersistenceStrategy\MySqlSingleStreamStrategy()
//);
//
//$streamName = new \Prooph\EventStore\StreamName('event_stream');
//$singleStream = new \Prooph\EventStore\Stream($streamName, new ArrayIterator());
//
//if (!$eventStore->hasStream($streamName)) {
//    $eventStore->create($singleStream);
//}
//
//$aggregateRepository = new \Prooph\EventSourcing\Aggregate\AggregateRepository(
//    $eventStore,
//    \Prooph\EventSourcing\Aggregate\AggregateType::fromAggregateRootClass(\Librarian\Charging\Domain\Account::class),
//    new \Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator()
//);
//
//$accountRepository = new \Librarian\Charging\Infrastructure\EventSourced($aggregateRepository);
//
//$projectionManager = new \Prooph\EventStore\Pdo\Projection\MySqlProjectionManager($eventStore,$connection->getWrappedConnection());