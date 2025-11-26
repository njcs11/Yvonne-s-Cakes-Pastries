<?php


namespace App\Services;


use App\Models\User;


interface UserManagementServiceInterface
{
public function createUser(array $data): User;
public function deleteUser(int $targetUserId): void;
public function changeUserRole(int $targetUserId, int $newRoleId): void;
public function updateStatus(int $targetUserId, string $status): void;
public function getRolePrivileges(int $roleID);
}