<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'role')->latest()->get();
    }
    public function getById($id)
    {
        return User::select('id', 'name', 'email', 'role')->findOrfail($id);
    }
    public function create(array $data)
    {
        return User::create($data);
    }
    public function update($id, array $data)
    {
        $user = User::findOrFail($id);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
}
