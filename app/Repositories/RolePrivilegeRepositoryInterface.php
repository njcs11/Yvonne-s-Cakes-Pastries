<?php


namespace App\Repositories;


interface RolePrivilegeRepositoryInterface
{
public function findPrivilegeByRole(int $roleID);
public function addPrivilegeToRole(int $roleID, int $privilegeID): void;
public function removePrivilegeFromRole(int $roleID, int $privilegeID): void;
}