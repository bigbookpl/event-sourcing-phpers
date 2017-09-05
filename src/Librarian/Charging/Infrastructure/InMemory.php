<?php

namespace Librarian\Charging\Infrastructure;

use Librarian\Charging\Domain\Account;
use Librarian\Charging\Domain\AccountRepository;

class InMemory implements AccountRepository
{

    public function get($id): Account
    {
        // TODO: Implement get() method.
    }

    public function save(Account $account)
    {
        // TODO: Implement save() method.
    }
}