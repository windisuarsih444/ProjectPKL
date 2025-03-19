<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        // query untuk mengambil data user dengan pencarian
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");

        // pagination
        })->paginate(5)->appends(request()->query()); 

        return view('backend.user.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // cari user berdasarkan ID
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // ambil data user
        $user = User::findOrFail($id);

        // update data user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // password diisi = update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {

        User::findOrFail($id)->delete();
        return redirect()->route('user')->with('success', 'User berhasil dihapus.');
    }
}
