<?php

use Librarian\Charging\Domain\Account;
use Money\Money;
use Ramsey\Uuid\Uuid;

require_once __DIR__.'/vendor/autoload.php';
require 'setup.php';

$id = Uuid::uuid4();
$currency = new \Money\Currency('PLN');
$account = Account::create($id, $currency);

$account->charge(new Money(400, new \Money\Currency('PLN')));
$account->activate();

$account->charge(new Money(400, new \Money\Currency('PLN')));
$account->charge(new Money(200, new \Money\Currency('PLN')));
$account->cancelDebit('client die');

$account->getBalance()->getAmount();

$accountRepository->save($account);

dump($accountRepository->get(Uuid::fromString($id)));