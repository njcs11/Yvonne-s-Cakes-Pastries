<?php


namespace App\Proxies;


use App\Services\UserManagementServiceInterface;
use App\Repositories\RolePrivilegeRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class UserManagementAuthorizationProxy implements UserManagementServiceInterface
{
protected $realService;
protected $privilegeRepo;


public function __construct(
UserManagementServiceInterface $realService,
RolePrivilegeRepositoryInterface $privilegeRepo
) {
$this->realService = $realService;
$this->privilegeRepo = $privilegeRepo;
}


protected function authorize(string $requiredPrivilege)
{
$user = Auth::user();
if (! $user) {
throw new \Exception('Unauthorized');
}


$privileges = $this->privilegeRepo->findPrivilegeByRole($user->roleID);


foreach ($privileges as $p) {
if (isset($p->privilegeName) && $p->privilegeName === $requiredPrivilege) {
return true;
}
}


throw new \Exception('Forbidden');
}


public function createUser(array $data): \App\Models\User
{
$this->authorize('CREATE_USER');
return $this->realService->createUser($data);
}


public function deleteUser(int $targetUserId): void
{
$this->authorize('DELETE_USER');
$this->realService->deleteUser($targetUserId);
}


public function changeUserRole(int $targetUserId, int $newRoleId): void
{
$this->authorize('CHANGE_ROLE');
$this->realService->changeUserRole($targetUserId, $newRoleId);
}


public function updateStatus(int $targetUserId, string $status): void
{
$this->authorize('UPDATE_STATUS');
$this->realService->updateStatus($targetUserId, $status);
}


public function getRolePrivileges(int $roleID)
{
$this->authorize('VIEW_PRIVILEGES');
return $this->realService->getRolePrivileges($roleID);
}
}