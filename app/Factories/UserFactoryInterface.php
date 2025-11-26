<?php


namespace App\Factories;


use App\Models\User;


interface UserFactoryInterface
{
public function createUser(string $username, string $rawPassword, int $roleId): User;
public function createUserWithDefaults(string $username, string $rawPassword): User;
}