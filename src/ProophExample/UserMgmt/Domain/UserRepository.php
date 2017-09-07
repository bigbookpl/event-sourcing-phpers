<?php

namespace ProophExample\UserMgmt\Domain;

use Ramsey\Uuid\Uuid;

interface UserRepository
{
    public function get(Uuid $uuid): ?User;

    public function save(User $user): void;
}