<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'created_at')
            ->get();
    }

    public function getPaginated($perPage = 10)
    {
        return User::select('id', 'name', 'email', 'created_at')
            ->latest()
            ->paginate($perPage);
    }

    public function getById($id)
    {
        return User::select('id', 'name', 'email', 'created_at', 'updated_at')
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        // Hash password before creating
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);

        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}