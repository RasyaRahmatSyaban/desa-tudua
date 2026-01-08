<?php
namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getPaginated();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $this->userService->create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $this->userService->update($id, $validated);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        if ($id == auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        $this->userService->delete($id);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}