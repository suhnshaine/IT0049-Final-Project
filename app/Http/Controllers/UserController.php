<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.form', [
            'title' => 'Add Staff User',
            'user' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num|min:3|max:50|unique:users,username',
            'full_name' => 'required|min:2|max:100',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $avatar = null;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')
                ->store('avatars', 'public');
        }

        User::create([
            'username' => trim($request->username),
            'full_name' => trim($request->full_name),
            'password' => Hash::make($request->password),
            'avatar' => $avatar
        ]);

        return redirect()
            ->route('users.index')
            ->with('message', 'Staff user added successfully.');
    }

    public function edit(User $user)
    {
        return view('users.form', [
            'title' => 'Edit Staff User',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|alpha_num|min:3|max:50|unique:users,username,' . $user->id,
            'full_name' => 'required|min:2|max:100',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = [
            'username' => trim($request->username),
            'full_name' => trim($request->full_name)
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request
                ->file('avatar')
                ->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('message', 'Staff user updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', 'Staff user deleted successfully.');
    }
}