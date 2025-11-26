<?php


namespace App\Repositories;


use App\Models\User;


class UserRepository implements UserRepositoryInterface
{
public function findById(int $userID): ?User
{
return User::find($userID);
}


public function findByUsername(string $username): ?User
{
return User::where('username', $username)->first();
}


public function findAllUsersByRole(int $roleID)
{
return User::where('roleID', $roleID)->get();
}


public function save(User $user): void
{
$user->save();
}


public function delete(int $userID): void
{
User::destroy($userID);
}


public function updateStatus(int $userID, string $status): void
{
$user = User::find($userID);
if ($user) {
$user->status = $status;
$user->save();
}
}
}