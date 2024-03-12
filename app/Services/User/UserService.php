<?php

namespace App\Services\User;

use App\Enums\UserRole;
use App\Models\User;
use App\Services\Contracts\User\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use App\Helpers\XorHelper;

class UserService implements UserServiceInterface
{
    public function create(array $data, $role): Model
    {
        if (!in_array($role, UserRole::getValues())) {
            throw new InvalidArgumentException();
        }

        // Apply XOR encryption to specific fields
        $data['name'] = XorHelper::xor($data['name']);
        $data['password'] = XorHelper::xor($data['password']);
        $data['email'] = XorHelper::xor($data['email']);

        $user = User::query()->create(Arr::only($data, [
            'email',
            'name',
            'password',
        ]));

        $user->assignRole($role);

        return $user;
    }
}