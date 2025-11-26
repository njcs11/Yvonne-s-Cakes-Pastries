<?php


namespace App\Repositories;


use App\Models\User;


interface UserRepositoryInterface
{
public function findById(int $userID): ?User;
public function findByUsername(string $username): ?User;
public function findAllUsersByRole(int $roleID);
public function save(User $user): void;
public function delete(int $userID): void;
public function updateStatus(int $userID, string $status): void;
}