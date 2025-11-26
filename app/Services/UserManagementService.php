<?php


namespace App\Services;


use App\Repositories\UserRepositoryInterface;
use App\Factories\UserFactoryInterface;
use App\Repositories\RolePrivilegeRepositoryInterface;
use App\Models\User;


class UserManagementService implements UserManagementServiceInterface
{
protected $userRepository;
protected $userFactory;
protected $rolePrivilegeRepo;


public function __construct(
UserRepositoryInterface $userRepository,
UserFactoryInterface $userFactory,
RolePrivilegeRepositoryInterface $rolePrivilegeRepo
) {
$this->userRepository = $userRepository;
$this->userFactory = $userFactory;
$this->rolePrivilegeRepo = $rolePrivilegeRepo;
}


public function createUser(array $data): User
{
$user = $this->userFactory->createUser(
$data['username'],
$data['password'],
$data['roleID']
);


$this->userRepository->save($user);


return $user;
}


public function deleteUser(int $targetUserId): void
{
$this->userRepository->delete($targetUserId);
}


public function changeUserRole(int $targetUserId, int $newRoleId): void
{
$user = $this->userRepository->findById($targetUserId);
if ($user) {
$user->roleID = $newRoleId;
$this->userRepository->save($user);
}
}


public function updateStatus(int $targetUserId, string $status): void
{
$this->userRepository->updateStatus($targetUserId, $status);
}


public function getRolePrivileges(int $roleID)
{
return $this->rolePrivilegeRepo->findPrivilegeByRole($roleID);
}
}