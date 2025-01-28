<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function index() {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    function edit(Role $uuid) {
        $role =  $uuid;
        $permissions = Permission::all();
        return view('role.edit', compact('role','permissions'));
    }

    function update(UpdateRoleRequest $request, Role $uuid) {
        $role = $uuid;
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }
}
