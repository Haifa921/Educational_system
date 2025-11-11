<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        // Simple middleware - check if user is admin
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Get role statistics from users table
        $roleStats = [
            'admin' => User::where('role_name', 'admin')->count(),
            'department_head' => User::where('role_name', 'department_head')->count(),
            'professor' => User::where('role_name', 'professor')->count(),
            'student' => User::where('role_name', 'student')->count(),
        ];

        $roles = [
            (object)[
                'id' => 1,
                'name' => 'admin',
                'users_count' => $roleStats['admin'],
                'description' => 'صلاحيات كاملة على النظام',
                'created_at' => now()
            ],
            (object)[
                'id' => 2,
                'name' => 'department_head', 
                'users_count' => $roleStats['department_head'],
                'description' => 'إدارة الأقسام والموظفين',
                'created_at' => now()
            ],
            (object)[
                'id' => 3,
                'name' => 'professor',
                'users_count' => $roleStats['professor'],
                'description' => 'إدارة المواد والمحاضرات',
                'created_at' => now()
            ],
            (object)[
                'id' => 4,
                'name' => 'student',
                'users_count' => $roleStats['student'], 
                'description' => 'الوصول للمواد والدروس',
                'created_at' => now()
            ]
        ];

        $roles = collect($roles);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return redirect()->route('roles.index')
            ->with('info', 'يمكن إدارة الأدوار من خلال تعديل المستخدمين مباشرة.');
    }

    public function store(Request $request)
    {
        return redirect()->route('roles.index')
            ->with('info', 'يمكن إدارة الأدوار من خلال تعديل المستخدمين مباشرة.');
    }

    public function show($id)
    {
        $roleNames = [
            1 => 'admin',
            2 => 'department_head', 
            3 => 'professor',
            4 => 'student'
        ];

        $roleName = $roleNames[$id] ?? 'unknown';
        
        $role = (object)[
            'id' => $id,
            'name' => $roleName,
            'users_count' => User::where('role_name', $roleName)->count(),
            'description' => $this->getRoleDescription($roleName),
            'users' => User::where('role_name', $roleName)->get(),
            'created_at' => now()
        ];

        return view('roles.show', compact('role'));
    }

    public function edit($id)
    {
        return redirect()->route('roles.index')
            ->with('info', 'يمكن تعديل أدوار المستخدمين من خلال صفحة تعديل المستخدم.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('roles.index')
            ->with('info', 'يمكن تعديل أدوار المستخدمين من خلال صفحة تعديل المستخدم.');
    }

    public function destroy($id)
    {
        return redirect()->route('roles.index')
            ->with('error', 'لا يمكن حذف الأدوار الأساسية في النظام.');
    }

    private function getRoleDescription($roleName)
    {
        $descriptions = [
            'admin' => 'صلاحيات كاملة على النظام - يمكنه إدارة جميع المستخدمين والإعدادات',
            'department_head' => 'إدارة الأقسام الأكاديمية والموظفين - صلاحيات متوسطة',
            'professor' => 'إدارة المواد الدراسية والمحاضرات - صلاحيات محدودة',
            'student' => 'الوصول للمواد والدروس والمناهج - صلاحيات مشاهدة فقط'
        ];

        return $descriptions[$roleName] ?? 'لا يوجد وصف لهذا الدور';
    }
}