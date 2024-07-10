<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role
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

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Updated Successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        Role::create([
            'name' => $request->name
        ]);
        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully!');
    }

    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role
        ]);
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Deleted Successfully');
    }
}
