<?php

namespace App\Services\Contracts\User;

interface UserServiceInterface
{
    public function create(array $data, $role);
}