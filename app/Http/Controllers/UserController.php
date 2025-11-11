<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // No need for roles query - we're using hardcoded values
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_name' => $request->role
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'تم إضافة مستخدم بنجاح.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
{
    // No need for roles query - we're using hardcoded values
    return view('users.edit', compact('user'));
}

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|exists:roles,name'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_name' => $request->role
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'تم التعديل بنجاح.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'تم الحذف بنجاح.');
    }
}

// namespace App\Http\Controllers;

// use App\Models\User;
// use Spatie\Permission\Models\Role;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

// class UserController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('permission:view_users')->only('index', 'show');
//         $this->middleware('permission:create_users')->only('create', 'store');
//         $this->middleware('permission:edit_users')->only('edit', 'update');
//         $this->middleware('permission:delete_users')->only('destroy');
//     }

//     public function index()
//     {
//         $users = User::with('roles')->latest()->paginate(10);
//         return view('users.index', compact('users'));
//     }

//     public function create()
//     {
//         $roles = Role::all();
//         return view('users.create', compact('roles'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'roles' => 'required|array',
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         $user->syncRoles($request->roles);

//         return redirect()->route('users.index')
//             ->with('success', 'User created successfully.');
//     }

//     public function show(User $user)
//     {
//         $user->load('roles');
//         return view('users.show', compact('user'));
//     }

//     public function edit(User $user)
//     {
//         $roles = Role::all();
//         $user->load('roles');
//         return view('users.edit', compact('user', 'roles'));
//     }

//     public function update(Request $request, User $user)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email,' . $user->id,
//             'roles' => 'required|array',
//         ]);

//         $data = [
//             'name' => $request->name,
//             'email' => $request->email,
//         ];

//         if ($request->filled('password')) {
//             $request->validate([
//                 'password' => 'string|min:8|confirmed',
//             ]);
//             $data['password'] = Hash::make($request->password);
//         }

//         $user->update($data);
//         $user->syncRoles($request->roles);

//         return redirect()->route('users.index')
//             ->with('success', 'User updated successfully.');
//     }

//     public function destroy(User $user)
//     {
//         $user->delete();
//         return redirect()->route('users.index')
//             ->with('success', 'User deleted successfully.');
//     }
// }