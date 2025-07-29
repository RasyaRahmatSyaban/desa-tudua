<?php

namespace App\Services;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;


class PerangkatDesaService
{
    public function getAll()
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%')
                    ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->findOrFail($id);
    }
    public function create($data)
    {
        return PerangkatDesa::create($data);
    }
    public function update($id, array $data)
    {
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        $perangkatDesa->update($data);
        return $perangkatDesa;
    }
    public function delete($id)
    {
        return PerangkatDesa::destroy($id);
    }

}