<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|update-role|delete-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::paginate(5);
        return view('role-permission.role.index', compact('roles'));
    }

    // public function create()
    // {
    //     return view('role-permission.role.create');
    // }

    public function create(): View
    {
        return view('role-permission.role.create', [
            'permissions' => Permission::get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        // Role::create([
        //     'name' => $request->name
        // ]);
        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
        
        $role->syncPermissions($permissions);

        return redirect('roles')->with('status', 'Role Created Successfully');
    }

    public function show(Role $role): View
    {
        $rolePermissions = Permission::join("role_has_permissions","permission_id","=","id")
            ->where("role_id",$role->id)
            ->select('name')
            ->get();
        return view('role-permission.role.show', [
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function edit(Role $role)
    {
        if($role->name=='super-dmin'){
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_id",$role->id)
            ->pluck('permission_id')
            ->all();

        return view('role-permission.role.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);

        return redirect('roles')->with('status', 'Role Updated Successfully');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if($role->name=='super-admin'){
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }

        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted Successfully');
    }

    // public function addPermissionToRole($roleId)
    // {
    //     $permissions = Permission::get();
    //     $role = Role::findOrFail($roleId);
    //     $rolePermissions = DB::table('role_has_permissions')
    //         ->where('role_has_permissions.role_id', $role->id)
    //         ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
    //         ->all();

    //     return view('role-permission.role.add-permissions', [
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'rolePermissions' => $rolePermissions
    //     ]);
    // }

    // public function givePermissionToRole(Request $request, $roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required'
    //     ]);

    //     $role = Role::findOrFail($roleId);
    //     $role->syncPermissions($request->permission);

    //     return redirect()->back()->with('status', 'Permissions added to role');
    // }
}
