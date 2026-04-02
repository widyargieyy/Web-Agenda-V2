<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $dataUser = User::with('role')->latest()->get();
        $dataRole = Role::all();
        return view('admin.users.index', [
            'dataUser' => $dataUser,
            'dataRole' => $dataRole,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'is_active' => $request->is_active,
            'password' => Hash::make($request->password),
        ]);

        Alert::success('success', 'User Berhasil Ditambahkan!');
        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $data)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $data->id,
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->role_id = $request->role_id;
        $data->is_active = $request->is_active;

        if ($request->filled('password')) {
            $data->password = Hash::make($request->password);
        }

        $data->save();

        Alert::success('Success', 'User Berhasil Diperbarui!');
        return back()->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $data)
    {
        $data->delete();
        Alert::success('Success', 'User Berhasil Dihapus!');
        return back()->with('success', 'User berhasil dihapus!');
    }
}