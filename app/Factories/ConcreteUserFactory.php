<?php


namespace App\Factories;


use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ConcreteUserFactory implements UserFactoryInterface
{
public function createUser(string $username, string $rawPassword, int $roleId): User
{
return new User([
'username' => $username,
'password' => Hash::make($rawPassword),
'roleID' => $roleId,
'status' => 1,
]);
}


public function createUserWithDefaults(string $username, string $rawPassword): User
{
// default to roleID = 2 (regular user) — change as needed
return $this->createUser($username, $rawPassword, 2);
}
}