<?php


namespace App\Repositories;


use App\Models\Privilege;
use App\Models\Role;


class RolePrivilegeRepository implements RolePrivilegeRepositoryInterface
{
public function findPrivilegeByRole(int $roleID)
{
$role = Role::find($roleID);
return $role ? $role->privileges()->get() : collect();
}


public function addPrivilegeToRole(int $roleID, int $privilegeID): void
{
$role = Role::find($roleID);
if ($role) {
$role->privileges()->attach($privilegeID);
}
}


public function removePrivilegeFromRole(int $roleID, int $privilegeID): void
{
$role = Role::find($roleID);
if ($role) {
$role->privileges()->detach($privilegeID);
}
}
}